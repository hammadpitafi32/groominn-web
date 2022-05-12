<?php
namespace App\Repositories;
use App\Repositories\Interfaces\BookingInterface;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Str;

use Auth;
use App\Models\UserBusiness;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;

use Label84\HoursHelper\Facades\HoursHelper;

use Cartalyst\Stripe\Stripe;

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
		$stripe = Stripe::make(env('STRIPE_SECRET'));
		$token = $stripe->tokens()->create([
			'card' => [
				'number' => $request->card_no,
				'exp_month' => $request->exp_month,
				'exp_year' => $request->exp_year,
				'cvc' => $request->cvc
			]
		]);
		if(!isset($token['id']))
		{
			return response()->json([
				'success' => false,
				'message' => 'The stripe token was not generated correctly, Please contact support!'
			],400);
		}
		// dd($token);

		$customer = $stripe->customers()->create([
			'name' => Auth::user()->name,
			'email' => Auth::user()->email,
			'phone' => Auth::user()->phone,
			// 'address' => [
			// 	'line1' =>$this->line1,
			// 	'postal_code' => $this->zipcode,
			// 	'city' => $this->city,
			// 	'state' => $this->province,
			// 	'country' => $this->country
			// ],
			// 'shipping' => [
			// 	'name' => $this->firstname . ' ' . $this->lastname,
			// 	'address' => [
			// 		'line1' =>$this->line1,
			// 		'postal_code' => $this->zipcode,
			// 		'city' => $this->city,
			// 		'state' => $this->province,
			// 		'country' => $this->country
			// 	],
			// ],
			'source' => $token['id']
		]);

		$charge = $stripe->charges()->create([
			'customer' => $customer['id'],
			'currency' => 'USD',
			'amount' => 100,
			'description' => 'Payment for order no ' . 12365
		]);

		if($charge['status'] == 'succeeded')
		{
			dd('done');
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
		dd($request->all());
		$uniqid = Str::random(9);
        $user = $request->id ?  $this->user->find($request->id) : $this->user;

		$user = $this->user->updateOrCreate(
			[
				'email' => $request->email,
			],
			[
				'name' => $request->name,
				'password' => Hash::make($request->password),
				'role_id' => $request->role_id,
				'added_by' => $request->added_by,
			]
		);

		$user->user_detail()->updateOrCreate(
			[
				'user_id'=>$user->id,
			],
			[
				'phone'=>$request->phone,
				'gender'=>$request->gender,
				'date_of_birth'=>$request->date_of_birth,
				'address_line_1'=>$request->address_line_1,
				'address_line_2'=>$request->address_line_2,
				'country_id'=>$request->country_id,
                'state_id' => $request->state_id,
                'city' => $request->city,
		    	'zip_code' => $request->zip_code,
				'tax_id'=>$request->tax_id
			]
		);
		// dd($this->request->all(),$request->role_id);
		return $user;
		// return response()->json([
		// 	'success' => 200,
		// 	'user' => $user
		// ]);
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