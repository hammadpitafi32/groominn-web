<?php

namespace App\Services;

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase;
use App\Models\Notification as Notificat;

class PushNotificationService
{
    public function send($title, $body,$token =null,$from_user,$to_user,$type)
    {
        // $message = CloudMessage::withTarget('token', $token)
        //     ->withNotification(Notification::create($title, $body));

        // app('firebase')->messaging()->send($message);
        if($token !=null){
        	
        	$message = CloudMessage::withTarget('token', $token)
    		->withNotification(Notification::create($title, $body));
    		// ->withData(['key' => 'value']);

			// Firebase::send($message);
        }
        

		// Save in db
		$data=[
			'type'=>$type,
			'data'=>$body,
			'title'=>$title,
			'from_user'=>$from_user,
			'to_user'=>$to_user,
		];
		Notificat::create($data);
    }
}
