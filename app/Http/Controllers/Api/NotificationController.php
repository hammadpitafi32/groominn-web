<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Repositories\Interfaces\UserInterface;
use App\Models\Notification;

class NotificationController extends Controller
{

    protected $notification;
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function getNotifications(Request $request)
    {
        
        $notifications=$this->notification->with('from_user')->where('to_user',auth()->user()->id)->latest()->take(8)->get();
        
        return response()->json([
            'success' => true,
            'data' => $notifications
        ], 200);
        
    }

    public function getNotificationsCount(Request $request){

        $notificationsCount=$this->notification->with('from_user')->where('to_user',auth()->user()->id)->where('seen',0)->count();
        
        return response()->json([
            'success' => true,
            'data' => $notificationsCount
        ], 200);
    }
    public function seenNotification(Request $request){

        $notification=$this->notification->find($request->id);
        if($notification){
            $notification->seen=1;
            $notification->save();
        }
        return response()->json([
            'success' => true,
            'data' => $notification
        ], 200);
    }
    

}
