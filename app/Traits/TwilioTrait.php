<?php

namespace App\Traits;
use Auth;
use Twilio\Rest\Client;
use App\Models\User;

trait TwilioTrait {

    public static function TwilioSetup()
    {
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio_sid = env("TWILIO_SID");
        // $twilio_verify_sid = env("TWILIO_VERIFY_SID");

        return new Client($twilio_sid, $token);
    }
    
    public static function sentTwilioOtp($data)
    {
        // dd($data);
        $twilio_verify_sid = env("TWILIO_VERIFY_SID");
        $twilio = self::TwilioSetup();
        return $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($data['phone'], $data['method']);

    }

    public static function verifyOtp($data)
    {
        try {
            $twilio = self::TwilioSetup();
            $twilio_verify_sid = env("TWILIO_VERIFY_SID");
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create([
                "to" => $data['phone'],
                "code" => $data['code']
                ]
            );

            if ($verification->valid) {

                // $user = tap(User::where('phone', $data['phone']))->update(['isVerified' => true]);
                $user = User::with('user_detail')->whereHas('user_detail',function($q) use($data){
                    $q->where('phone',$data['phone']);
                })->first();

                if (!$user) {
                    return [
                        'success' => false,
                        'message' => 'Against this number user not found',
                        'action_require' => true

                    ];
                }
                $user = tap($user)->update([
                    'two_factor_code' => null,
                    'is_verified' => true
                ]);
                /* Authenticate user */
                return [
                    'success' => true,
                    'user' => $user
                ];
            }
            return [
                'success' => false,
                'message' => 'Invalid verification code entered!',
                'action_require' => true
            ];
        } catch (\Throwable $th) {
            //throw $th;
            $msg = $th->getMessage();
            if ($th->getStatusCode() == 404) 
            {
                $msg = 'Verification code is expired, please try new one!';

            }
            return [
                'success' => false,
                'message' => $msg,
                'action_require' => true

            ];
        }
    }

    

}