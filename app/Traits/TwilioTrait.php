<?php

namespace App\Traits;
use Auth;
use Twilio\Rest\Client;
use App\Models\User;

trait TwilioTrait {

    public static function TwilioSetup()
    {
        $token = env("TWILIO_AUTH_TOKEN","69abf8858fa5c1d41f5828c7b483244a");
        $twilio_sid = env("TWILIO_SID","AC58dee5e35c67a2d59ea31f46eddd478a");
        // $twilio_verify_sid = env("TWILIO_VERIFY_SID");

        return new Client($twilio_sid, $token);
    }
    
    public static function sentTwilioOtp($data)
    {
        $data['phone'] = self::removeSpecialCharacterForPhone($data['phone']);
        // dd($data);
        $twilio_verify_sid = env("TWILIO_VERIFY_SID","VA82216eb0e0ec8baa00476dd95e7070e6");
        $twilio = self::TwilioSetup();

        // $phone_number = $twilio->lookups->v2->phoneNumbers("03030100987")
        //                             ->fetch(["type" => ["carrier"]]);
        
        try {
            return $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($data['phone'], $data['method']);
        } catch (\Throwable $th) {
            $msg = $th->getMessage();
            if(str_contains($msg,"Invalid parameter `To`")){
                $msg = 'Invalid Phone Number, Please enter correct one!';
            }
            return [
                'success' => false,
                'message' => $msg,
                'action_require' => true

            ];
        }
        

    }

    public static function verifyOtp($data)
    {
        try {
            $twilio = self::TwilioSetup();
            $twilio_verify_sid = env("TWILIO_VERIFY_SID","VA82216eb0e0ec8baa00476dd95e7070e6");
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

    public static function removeSpecialCharacterForPhone($string) {
 
        $t = $string;
     
        $specChars = array(
            ' ' => '',    '!' => '',    '"' => '',
            '#' => '',    '$' => '',    '%' => '',
            '&' => '',    '\'' => '',   '(' => '',
            ')' => '',    '*' => '',     '-' => '' ,
            ',' => '',    '₹' => '',    '.' => '',
            '/-' => '',    ':' => '',    ';' => '',
            '<' => '',    '=' => '',    '>' => '',
            '?' => '',    '@' => '',    '[' => '',
            '\\' => '',   ']' => '',    '^' => '',
            '_' => '',    '`' => '',    '{' => '',
            '|' => '',    '}' => '',    '~' => '',
            '-----' => '',    '----' => '',    '---' => '',
            '/' => '',    '--' => '',   '/_' => '',

        );
     
        foreach ($specChars as $k => $v) {
            $t = str_replace($k, $v, $t);
        }
     
        return $t;
    }

    

}