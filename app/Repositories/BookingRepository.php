<?php
namespace App\Repositories;
use App\Repositories\Interfaces\BookingInterface;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Models\UserBusiness;
use App\Models\UserBusinessCategoryService;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;

use Label84\HoursHelper\Facades\HoursHelper;

use Cartalyst\Stripe\Stripe;
use App\Models\ UserStripeInfo;
use App\Models\ UserStripeCard;
class BookingRepository implements BookingInterface
{
	protected $booking;
	protected $request;
	public function __construct(Booking $booking,Request $request)
	{
		$this->booking = $booking;
		$this->request = $request;
	}
	public function find($id)
    {
        return $this->booking->findOrfail($id);
    }

     public function findBy($att, $value)
	{
		return $this->booking->where($att, $value);
	}

	public function create()
	{
		$request = $this->request;

		$validator = Validator::make($request->all(), [
            'service_ids' => 'required',
            'date' => 'required',
            'user_business_id' => 'required',
            'charges' => 'required',
            'card_no' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc' => 'required',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }

        $category_services = UserBusinessCategoryService::find($request->service_ids);

        $total_charges = $category_services->sum('charges');
        
		$payment_result = $this->stripePayment($request,$total_charges);

		if ($payment_result['success'] == false)
        {
            return response()->json([
                'success' => false,
                'msg' => $payment_result['result']->getMessage(),
            ]);
        }
		// dd($request->all());
		$uniqid = Str::random(9);
		$total_booking = Booking::withTrashed()->where('created_at','like', '%'.date('Y-m'). '%')->count();
        $total_booking +=1;

        $total_duration = null;

		$booking = Booking::create([
			'booking_no' => 'G-BK-'.date('ym').$total_booking,
			'user_id' => Auth::id(),
			'user_business_id' => $request->user_business_id,
			// 'total_duration' => $request->total_duration,
			'date' => $request->date,
			'estimated_time' => $request->estimated_time,
			'payment_type' => 'stripe',
			'charges' => $total_charges,
		]);

		foreach ($category_services as $category_service) 
		{
			$category_service->total_duration;
			$duration = $category_service->duration;

			if ($total_duration) 
			{
				$secs = strtotime($duration) - strtotime("00:00:00");
				$total_duration = date("H:i:s", strtotime($total_duration) + $secs);
			}
			else
			{
				$total_duration = $category_service->duration;
			}

			BookingService::create([
				'booking_id' => $booking->id,
				'user_business_category_service_id' => $category_service->id,
				'duration' => $category_service->duration,
				'charges' => $category_service->charges,
				'type' => $category_service->type,
			]);
		}
		$booking->update([
			'total_duration' => $total_duration
		]);
        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
	}

	public function stripePayment($request,$total_charges)
	{
		$stripe = Stripe::make(env('STRIPE_SECRET'));
		// dd(env('STRIPE_SECRET'));
		$token = $stripe->tokens()->create([
			'card' => [
				'number' => $request->card_no,
				'exp_month' => $request->exp_month,
				'exp_year' => $request->exp_year,
				'cvc' => $request->cvc
			]
		]);
		// dd($token);
		if(!isset($token['id']))
		{
			return response()->json([
				'success' => false,
				'message' => 'The stripe token was not generated correctly, Please contact support!'
			],400);
		}
		// dd($token);

		$customer = $this->createStripeCustomer($stripe,$token);

		$customer_object = UserStripeInfo::updateOrCreate([
            'user_id' => Auth::id()
        ],
        [
            'customer_id'   => $customer['id'],
        ]);

        $customer_card = $this->createStripeCard($stripe,$customer_object,$token);

        $charge = $stripe->charges()->create([
            'customer'    =>  $customer_object->customer_id,
            'currency'    =>  'USD',
            'amount'      =>  $total_charges,
            'description' =>  'Payment Charged'
        ]);

		if($charge['status'] == 'succeeded')
		{
			return $charges;
			// $this->makeTransaction($order->id,'approved');
			// $this->resetCart();
		}
		else
		{
			return response()->json([
				'success' => false,
				'message' => 'Error in Transaction!, Please contact support!'
			],400);
			// $this->thankyou = 0;
		}
	}

	public function createStripeCustomer($stripe,$token)
    {
        // create a new customer id
        $customer = $stripe->customers()->create([
			'name' => Auth::user()->name,
			'email' => Auth::user()->email,
			'phone' => Auth::user()->phone,
			'source' => $token['id']
		]);

        return $customer;
    }

    public function createStripeCard($stripe,$customer_object,$token)
    {
    	$card = $stripe->cards()->create($customer_object['customer_id'], $token['id']);
        // save customer card if card is not present
        $customer_card = UserStripeCard::updateOrCreate([
            'user_stripe_info_id' => $customer_object->id
        ],
        [
            'card_id'   => $card['id'],
            'last_four_digit' => $card['last4'],
            'card_type' => $card['brand']

        ]);

        return $customer_card;
    }

	public function getEstimatedTime()
	{
		$request = $this->request;
		$date = date('Y-m-d H:i:s',strtotime($request->date));
		$day = date('l',strtotime($date));

		$current_time = date('H:i:s');
		$estimated_time = 0;
		$no_of_employees = 5;

		$user_business = UserBusiness::with('user_business_schedules')->find($request->user_business_id);
		$bookings = $this->booking->where('user_business_id',$user_business->id)->whereDate('date',$date)->get();
		dd($bookings);
	}
	public function getEstimatedTimeold()
	{
		$request = $this->request;
		$date = date('Y-m-d H:i:s',strtotime($request->date));
		$day = date('l',strtotime($date));

		$current_time = date('H:i:s');
		$estimated_time = 0;

		$user_business = UserBusiness::with('user_business_schedules')->find($request->user_business_id);
		$bookings = $this->booking->where('user_business_id',$user_business->id)->whereDate('date',$date)->get();

		$no_of_employees = 2;

		$schedule = $user_business->user_business_schedules->where('day',$day)->first();


		$datetime1 = new DateTime($request->date.' '.$schedule->open_at);
		$datetime2 = new DateTime($request->date.' '.$schedule->close_at);
		$open_at = date('Y-m-d H:i:s',strtotime($request->date.' '.$schedule->open_at));
		$close_at = date('Y-m-d H:i:s',strtotime($request->date.' '.$schedule->close_at));


		$start_date    = date('Y-m-d H:i:s',strtotime($request->date.' '.$schedule->open_at));
        $end_date      = date('Y-m-d H:i:s',strtotime($request->date.' '.$schedule->close_at));
        $start    = new DateTime($start_date);
        $end      = (new DateTime($end_date))->modify('+1 day');
        $interval = DateInterval::createFromDateString('1 hour');
        $period   = new DatePeriod($start, $interval, $end);

        // dd(iterator_count($period));
        $hours = HoursHelper::create($open_at , $close_at, 60, 'Y-m-d H:i');
        dd($hours);
		dd($datetime1,$datetime2,$datetime1->diff($datetime2)->format('%H:%I:%S'),$datetime1->diff($datetime2)->format('%H'));
		
		if ($bookings->count() > 0) 
		{
			foreach ($bookings as $key => $booking) 
			{
    			$date = Carbon::parse($date);
    			$date->addHour($existing_time->format('H'));
    			$date->addMinutes($existing_time->format('i'));
    			$date->addSeconds($existing_time->format('s'));

				dump($existing_time->format('H'),$date->format('H:i:s'));
			}
			dd('sdfg');
		}


		/*1 hour chunk*/

		/*end*/

		dd($bookings->pluck('total_duration')->toArray(),$date);
	}

	
}