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

// use Cartalyst\Stripe\Stripe;
use App\Models\UserStripeInfo;
use App\Models\UserStripeCard;

use App\Traits\StripeTrait;

class BookingRepository implements BookingInterface
{
	use StripeTrait;

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
        // dd($request->all());
		$validator = Validator::make($request->all(), [
            'service_ids' => 'required',
            'date' => 'required',
            'user_business_id' => 'required',
            // 'charges' => 'required',
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
        $service_ids = explode(',',$request->service_ids);
        $category_services = UserBusinessCategoryService::find($service_ids);

        if ($category_services && $category_services->count() > 0 ) 
        {
        	$total_charges = $category_services->sum('charges');
        	if($total_charges > 0)
        	{
        		$request['total'] = $total_charges;
        		/*second step of 3d authenication after confirmation*/
	            if (@$request->payment_confrim_action && @$request->payment_intent_id)
	            {
	                // dd('dsf');
	                $stripe = StripeTrait::obj();
	                $payment_intent = $stripe->paymentIntents->retrieve(
	                  $request['payment_intent_id'],
	                );
	            }
	            else
	            {
	                $payment_result = $this->stripePaymentProcess($request);

	                if ($payment_result['success'] == true && $payment_result['requires_action'] == false) 
	                {
	                    try {
	                        $payment_intent = $payment_result['intent'];
	                    } catch (Exception $e) {
	                        return response()->json([
	                            'success' => false,
	                            'msg' => $e->getMessage(),
	                        ]);
	                    }
	                    
	                }
	                else
	                {
	                	/*for 3d confirmation*/
	                    return response()->json($payment_result);

	                }
	            }
	            if (@$payment_intent) 
	            {
                    $billing = $payment_intent['charges']['data'][0];
	                $request['payment_intent_id'] = $payment_intent['id'];
	                $request['billing_id'] = $billing['id'];
	                $request['balance_transaction'] = $billing['balance_transaction'];
	                $request['billing_status'] = $billing['status'];
	                $request['receipt_url'] = $billing['receipt_url'];
	            }
                // dd($request);

        	}
        }
        else{
            return response()->json([
                'success' => false,
                'msg' => 'Selected Service not found!'
            ], 400);
        }
		/*save booking*/
		$uniqid = Str::random(9);
		$total_booking = Booking::withTrashed()->where('created_at','like', '%'.date('Y-m'). '%')->count();
        $total_booking +=1;

        $total_duration = null;
        try {
            $estimated_time = $this->getEstimatedTime();
        } catch (\Throwable $th) {
            $estimated_time = date('Y-m-d H:i:s');
        }

		$booking = Booking::create([
			'booking_no' => 'G-BK-'.date('ym').$total_booking,
			'user_id' => Auth::id(),
			'user_business_id' => $request->user_business_id,
			// 'total_duration' => $request->total_duration,
			'date' =>  date('Y-m-d H:i:s', strtotime($request->date)),
			'estimated_time' => $estimated_time,
			'charges' => $total_charges,
			/*billing*/
			'payment_type' => 'stripe',
            'payment_intent_id' => @$request->payment_intent_id,
            'billing_id' => @$request->billing_id,
            'balance_transaction' => @$request->balance_transaction,
            'billing_status' => @$request->billing_status,
            'receipt_url' => @$request->receipt_url,
		]);
        // dd($category_services);
		foreach ($category_services as $category_service) 
		{
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
				'category_name' => @$category_service->user_category->category->name,
				'service_name' =>  @$category_service->user_service->name,
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

			return $data = [
                'success' => false,
                'message' => $e,
            ];
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

    /*stripe payment functions*/
    public function stripePaymentProcess($request)
    {
        $stripe = StripeTrait::obj();
        /*create stripe customer*/
        $customer_object = UserStripeInfo::where('user_id',Auth::id())->first();
        // dd($customer_object);

        try {
        	if ($customer_object) 
        	{
        		$customer = $stripe->customers->retrieve(
	              $customer_object->customer_id,
	              []
	            );
        	}
        	else
        	{
            	$customer = $this->createStripeCustomer($stripe);

        	}
           
        } catch (Exception $e) {
            $customer = $this->createStripeCustomer($stripe);
        }
        // dd($customer);
        /*update or create in db*/
        $customer_object = UserStripeInfo::updateOrCreate([
            'user_id' => Auth::id()
        ],
        [
            'customer_id'   => $customer['id'],
        ]);
        // dd($customer_object);
        /*end*/
        try {
            $card_no = str_replace(' ', '', $request->card_no);
            $payment_method = $stripe->paymentMethods->create([
              'type' => 'card',
              'card' => [
                'number' => $card_no,
                'exp_month' => $request->exp_month,
				'exp_year' => $request->exp_year,
				'cvc' => $request->cvc
              ],
            ]);
            // dd($payment_method);
        } catch (Exception $e) {
            return [
                'success' => false,
                'msg' => $e->getMessage()
            ];
        }

        $request['payment_method_id'] = $payment_method->id;
        /*convert to cents*/
        $request['total_in_cent'] = ($request['total']*100);
        // dd($request->all());
        return $this->stripePaymentIntent($stripe,$request,$customer_object);

    }

    public function createStripeCustomer($stripe)
    {
        // create a new customer id
        $customer = $stripe->customers->create([
            'name' => Auth::user()->name,
			'email' => Auth::user()->email,
			'phone' => Auth::user()->phone,
        ]);

        return $customer;
    }

    public function stripePaymentIntent($stripe,$request,$customer_object = null)
    {
        $intent = null;
        try{

            if (isset($request['payment_method_id']) && $customer_object) 
            {
                # Create the PaymentIntent
                $intent = $stripe->paymentIntents->create([
                    'customer' => $customer_object->customer_id,
                    'amount' => $request->total_in_cent,
                    'currency' => 'usd',
                    'payment_method_types' => ['card'],
                    'payment_method' => $request['payment_method_id'],
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                ]);
            }
            // dd(isset($request['payment_intent_id']));
            if (isset($request['payment_intent_id']) && $request['payment_intent_id']) 
            {
                // dd('intent');
                $intent = $stripe->paymentIntents->retrieve(
                  $request['payment_intent_id'],
                );
                $intent->confirm();
            }
            if ($intent) 
            {
                return $this->generateResponse($intent);
            }

        } 
        catch (\Stripe\Exception\ApiErrorException $e) {
            # Display error on client
            return [
                'success' => false,
                'msg' => $e->getMessage()
            ];
        }
    }
    public function generateResponse($intent) 
    {
        # Note that if your API version is before 2019-02-11, 'requires_action'
        # appears as 'requires_source_action'.
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'use_stripe_sdk') {
            # Tell the client to handle the action
            return [
                'success' => true,
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ];
        } 
        else if ($intent->status == 'succeeded') {
            # The payment didn’t need any additional actions and completed!
            # Handle post-payment fulfillment
            return [
                'success' => true,
                'requires_action' => false,
                'intent' => $intent

            ];
        } else {
            # Invalid status
            return [
                'success' => false,
                'msg' => "Invalid PaymentIntent status"
            ];
        }
    }
    /*after 3d pay conformation*/
    public function confirmStripePayment(Request $request)
    {
        $stripe = StripeTrait::obj();
        $result = $this->stripePaymentIntent($stripe,$request);
        return response()->json($result);
    }

    public function updateStripePaymentInfo($order)
    {
        if ($order->payment_intent_id) {
            $stripe = StripeTrait::obj();
            $stripe->paymentIntents->update(
              $order->payment_intent_id,
              ['metadata' => [
                    'order_id' => $order->order_no,
                    'description' =>  'Payment charged against '.$order->order_no,
                ]]
            );
        }
    }

	public function getEstimatedTime()
	{
		$request = $this->request;
		$date = date('Y-m-d H:i:s',strtotime($request->date));
		$day = date('l',strtotime($date));

		$current_time = date('H:i:s');
		$estimated_time = 0;
		$user_business = UserBusiness::with('user_business_schedules')->find($request->user_business_id);
		$no_of_employees = ($user_business->no_of_employees?:1);
        // dd($no_of_employees);
		$bookings = $this->booking->where('user_business_id',$user_business->id)->whereDate('date',$date)->where('status','pending')->get();
        $total_time_left = date('H:i:s');
        if ($bookings->count() > $no_of_employees) 
        {
            foreach ($bookings as $booking) 
            {
                $created_duration = date('H:i:s',strtotime($booking->created_at));
                $total_duration = $booking->total_duration;
                $left = date('H:i:s', strtotime($current_time) - strtotime($created_duration));
                $time_left = date('H:i:s', strtotime($total_duration) - strtotime($left));
                $total_time_left = date('H:i:s', strtotime($total_time_left) + strtotime($time_left));
            }
        }
        
        return date('Y-m-d H:i:s', strtotime($total_time_left));
    
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

    public function bookingQuery()
    {
        $request = $this->request;
        // dd($request->all());
        $user_id = @$request->user_id;
        $id = @$request->id;
        $user_business_id = null;
        if(Auth::user()->role->name == 'Provider')
        {
            $user_business_id = Auth::user()->user_business->id;
        }

        if(Auth::user()->role->name == 'Client')
        {
            $user_id = Auth::id();
        }
        // dd($id);
        $booking_query = $this->booking
        ->when($id,function($q) use($id){
            $q->where('id',$id);
        })
        ->when($user_id,function($q) use($user_id){
            $q->where('user_id',$user_id);
        })
        ->when($user_business_id,function($q) use($user_business_id){
            $q->where('user_business_id',$user_business_id);
        })
        ->whereHas('booking_services')
        ->select('id','user_id','user_business_id','booking_no','total_duration','date','estimated_time','payment_type','status','charges','created_at')
        ->with(['user.user_detail' => function ($q) {
            $q->select('user_id','phone','gender','date_of_birth','address_line_1','address_line_2','country_id','state_id','city','zip_code','tax_id');
        }])
        ->with(['user' => function ($q) {
            $q->select('id','name','email');
        }])
        ->with(['user_business.user' => function ($q) {
            $q->select('id','name','email');
        }])
        ->with(['user_business' => function ($q) {
            $q->select('id','user_id','name','address','city');
        }])
        
        // ->with(['booking_services.category_services.user_category' => function ($q) {
        //     // $q->select('booking_id','user_business_category_service_id','type','duration','charges','type');
        // }])
        ->with(['booking_services' => function ($q) {
            $q->select('booking_id','user_business_category_service_id','category_name','service_name','type','duration','charges','type');
        }]);

        return $booking_query;
    }


    public function getBookings()
    {
        
        $bookings = $this->bookingQuery()->get();

        return response()->json([
            'success' => true,
            'data' => $bookings
        ], 200);
    }

    public function bookingDetail()
    {
        $booking = $this->bookingQuery()->first();

        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }
    public function bookingCancel()
    {
        $request = $this->request;
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'detail' => 'required',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }
        $booking = $this->booking->find($request['id']);
        if (!$booking) 
        {
            return response()->json([
                'message' => 'Booking not found, Please contact support if you have any query regarding this !',
                'success' => false
            ], 400);
        }
        // dd($booking);
        $booking->status = "cancelled";
        $booking->cancel_detail = $request['detail'];
        $booking->cancel_by = Auth::id();
        $booking->save();

        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }

	
}