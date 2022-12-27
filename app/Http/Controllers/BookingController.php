<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;


class BookingController extends Controller
{
   
    protected $bookingStatus;

    public function __construct()
    {
        $this->bookingStatus = [0=>'pending',1=>'accepted',2=>'rejected',3=>'completed',4=>'cancel',5=>'drop'];
    }
    public function index()
    {
        $bookings=Booking::with('user_business')->get();
        $status=$this->bookingStatus;
        return view('admin.booking.index',compact('bookings','status'));
    }
   //  public function updateSetting(Request $request)
   //  {

   //      // Validate the request data
   //      $request->validate([
  
   //          'site_logo' => 'nullable|image|max:2048'
   //      ]);

   //      // Update the site avatar, if provided
   //      if ($request->hasFile('site_logo')) {
   //          $avatar = $request->file('site_logo');
   //          $avatar_path = $avatar->store('site', 'public');
   //          // $user->avatar_path = $avatar_path;
   //      }
   //      $settings = SiteSetting::updateOrCreate(

   //          [
   //              'name' => 'logo',
   //          ],
   //          [
   //              'value' => $avatar_path,
   //          ]
   //       );
   //      $settings = SiteSetting::updateOrCreate(

   //          [
   //              'name' => 'radius',
   //          ],
   //          [
   //              'value' => $request->radius,
   //          ]
   //       );

   
   //      // Redirect the user back with a success message
   //      return redirect()->back()->with('success', 'Your settings has been updated successfully!');
   // }

    // public function getEmailTemplates(){

    //     $emails=EmailTemplate::all();
      
    //     return view('admin.emailTemp.index',compact('emails'));
    // }

    public function BookingDelete(Request $request){
        
        $request->validate([
            'id' => 'required',
            
        ]);

        $booking=Booking::find($request->id);
        $booking->delete();
        
        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }
    
    public function updateBookingStatus(Request $request){
        
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
       
        $booking=Booking::find($request->id);
        $booking->status=$request->status;
        $resp=$booking->save();
        
        return response()->json([
            'success' => true,
            'data' => $booking
        ], 200);
    }

}
