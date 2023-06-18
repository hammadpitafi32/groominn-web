<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\BookingInterface;
use App\Services\PushNotificationService;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;
use App\Models\UserBusiness;


class BookingController extends Controller
{
    protected $booking;
    public function __construct(BookingInterface $booking)
    {
        $this->booking = $booking;
    }

    public function create(Request $request)
    {

        return $this->booking->create();
    }

    public function getEstimatedTime(Request $request)
    {
        $data = $this->booking->getEstimatedTime();
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function shopCurrentBooking(Request $request)
    {

        return $this->booking->currentBookings();

    }

    public function getBookings(Request $request)
    {
        return $this->booking->getBookings();

    }
    public function bookingDetail(Request $request)
    {
        return $this->booking->bookingDetail();

    }
    public function bookingCancel(Request $request)
    {
        return $this->booking->bookingCancel();
    }

    public function getUserEarning(Request $request)
    {
        return $this->booking->getUserEarning();
    }
    public function cancelBooking(Request $request)
    {
        return $this->booking->cancelUserBooking();
        
    }
    public function acceptBooking(Request $request){
        return $this->booking->acceptBookingByProvider();
    }
    public function rejectBooking(Request $request){
        return $this->booking->rejectBookingByProvider();
    }
    public function updateStatus(Request $request)
    {

        return $this->booking->updateBookingsStatus();

    }
    public function postFeedback(Request $request){

        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'id'=>'required',
            'user_business_id'=>'required',
            'user_business_category_service_id'=>'required',

        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }
        
        $data=[
            'rating'=>$request->rating,
            'user_id'=>auth()->user()->id,
            'user_business_id'=>$request->user_business_id,
            'booking_id'=>$request->id,
            'user_business_category_service_id'=>$request->user_business_category_service_id,
            'detail'=>$request->detail,

        ];
        $saveReview=Review::create($data);
        $noti=new PushNotificationService();
        $business=UserBusiness::find($request->user_business_id);

        $user=User::find($business->user_id);
        
        if(!$user){

            return response()->json([
                'success' => false,
                'message' => 'user not found',
            ], 404);
        }
        $token=$user->device_token;
        $title='Feed back';
        $body='Alert! Client submitted the feedback.';
        // $token=$provider->device_token;
        $from_user=auth()->user()->id;
        $to_user=$business->user_id;
        $type='FEEDBACK';
        $noti->send($title, $body,$token,$from_user,$to_user,$type);

        return response()->json([
            'success' => true,
            'data' => $saveReview
        ], 200);
 
    }

}
