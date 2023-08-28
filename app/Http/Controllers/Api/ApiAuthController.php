<?php
 
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterAuthRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Http;

// 3rd part packages
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

// models
use App\Models\User;
use App\Models\Role;
use App\Models\BusinessHour;
use App\Models\EmailTemplate;
// traits
use App\Traits\UserTrait;
use App\Traits\TwilioTrait;
// notication
use App\Notifications\OtpNotification;
use App\Services\PushNotificationService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Storage;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use File;
use GoogleMaps;



class ApiAuthController extends Controller
{
    use UserTrait;
    use TwilioTrait;

    public $loginAfterSignUp = true;
 
    public function register(Request $request)
    {
        $response = $this->createOrUpdateUser($request);
        
        if ($response && $response->getStatusCode() == 400) {
            return $response;
        }

        if ($response && $response->getStatusCode() == 201 ) {
            return $response;
        }
      
        if ($this->loginAfterSignUp ) {
            
            // $pushNotificationService = new PushNotificationService();

            // $pushNotificationService->send('My Notification', 'This is the body of my notification', 'my_device_token');

            return $this->login($request);
        }
        return $response;
    }
 
    public function login(Request $request)
    {

        $input = $request->only('email', 'password');
        $jwt_token = null;
        
        // dd($request->all());
        $user = User::with('user_detail')->where('email',$request->email)
            ->orWhereHas('user_detail',function($q) use($request){
                $q->where('phone',$request['phone']);
            })
            ->first();
        
        if (!@$user->is_verified) 
        {
            if (!$jwt_token = JWTAuth::attempt($input)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }
            return response()->json([
                'success' => false,
                'data' => $user,
                'message' => 'Please verify your account first!',
                'action_require' => true
            ], 401);
        }
        if ($request['verified']) 
        {
            
            if (!$jwt_token=JWTAuth::fromUser($user)) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Credentials',
                ], 401);
            }
            Auth::login($user);
        }
        else
        {
            if (!$jwt_token = JWTAuth::attempt($input)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email or Password',
                ], 401);
            }
        }
        $isTimeAdded=false;
        $user = Auth::user();

        if($user && $user->user_business){
            $business=BusinessHour::where('user_businesses_id',$user->user_business->id)->first();
            if($business){
                $isTimeAdded=true;
            }
        }
        if($request->has('device_token')){
            $user->device_token=$request->device_token;
            $user->save();
        }
        

        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['role'] = $user->role->name;
        $data['phone'] = $user->user_detail->phone;
        $data['id'] = $user->id;
        $data['is_shop']=false;
        if($user && $user->user_business){
            $data['is_shop'] = ($user->user_business && $user->user_business->id?true:false);
        }
        $data['avatar'] = $user->avatar_path;
        $data['isTimeAdded'] = $isTimeAdded;
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'data' => $data,
        ]);
    }
 
    public function logout(Request $request)
    {

        $token['token'] = $request->bearerToken();
        //valid credential
        $validator = Validator::make($token, [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 400);
        }
 
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
 
    public function getAuthUser(Request $request)
    {
        $token['token'] = $request->bearerToken();
        //valid credential
        $validator = Validator::make($token, [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->messages()
            ], 400);
        }
        
        $user = JWTAuth::authenticate($request->token);
        $decode_user = json_decode($user);

        $user = User::with('user_detail')->find($decode_user->id);

        $full_name = explode(' ',$user->name);
        $user->first_name = $full_name[0];
        // dd($user);
        // $user['role_name'] = $user->role->name;
        // $user->last_name = null;
        if ((array_key_exists(1, $full_name))) 
        {
            $user->last_name = $full_name[1].' '.(array_key_exists(2, $full_name)?$full_name[2]:'');
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function sendOtp(Request $request)
    {
        // dd($request->all());
        if($request['type'] == 'phone')
        {
            if (!$request['phone']) 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Phone number is not found, please try other option!',
                    'action_require' => true
                ], 400);
            
            }
            $data['phone'] = $request['phone'];
            $data['method'] = "sms";

            $twilio_response = self::sentTwilioOtp($data);

            if (!$twilio_response) 
            {
                return response()->json($twilio_response, 400);
            }
            return response()->json([
                'success' => true,
                'message' => 'Verification code sent to phone number',
                'action_require' => true
            ], 200);
        }

        if ($request['type'] == 'email')
        {
            $user = $this->generateOtp($request);

            $getTemplate=EmailTemplate::where('title','otp')->first();

            $content=$getTemplate->content;

            $replaceAble=[$user->name,$user->two_factor_code];

            $searchAble=['@name','@code'];

            $newContent=str_replace($searchAble, $replaceAble, $content);
            
            $details = [
                    'title' => $getTemplate->title,
                    'subject' => $getTemplate->title,
                    'body'=>$newContent
            ];
            \Mail::to($user->email)->send(new \App\Mail\GroomInnMail($details));
            // $user->notify(new OtpNotification());
            return response()->json([
                'success' => true,
                'message' => 'Verification code sent to email',
                'action_require' => true
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Please Select Verification Platform',
            'action_require' => true
        ], 400);
    }

    public function otpVerify(Request $request)
    {
        // dd($request->all());
        if ($request['type'] == 'phone')
        {
            
            $response = TwilioTrait::verifyOtp($request);
        }

        if ($request['type'] == 'email')
        {
            $response = $this->verifyEmailOtp($request);
        }

        if ($response['success'] != true) 
        {
            return response()->json($response, 400);
        }

        if ($request->method == 'forget-password') 
        {
            $user = $response['data'];
            if($user)
            {
                $user->two_factor_code = rand(000000000,999999999);
                // $user->password = Hash::make($request->password);
                $user->save(); 
                $response['token'] = $user->two_factor_code;
            }
            return response()->json($response, 200);
        }
        else
        {
            $request['verified'] = true;
            return $this->login($request);
        }

        

    }

    public function resetPassword(Request $request)
    {
        $user = User::where('two_factor_code',$request->code)->where('email',$request->email)
            ->orWhereHas('user_detail',function($q) use($request){
                $q->where('phone',$request['phone']);
            })
            ->first();
        if ($user) 
        {
            $user->password = Hash::make($request->password);
            $user->save(); 
            $request['verified'] = true;
            return $this->login($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid Credentials or token',
        ], 401);
    }

    public function redirectToFacebook(){

        try {
            return Socialite::driver('facebook')->stateless()->redirect();
        } catch (Exception $e) {
           return $e->getMessage();
            
        }
    }
    public function redirectToGoogle(){

        try {
            return Socialite::driver('google')->stateless()->redirect();
        } catch (Exception $e) {
           return $e->getMessage();
            
        }
    }
    // public function getShopData(){

    //     $googleMapsApiKey = 'AIzaSyDoWPQ82mh0PFBOYhhHCK924wOffWOFSdc';

    //     // Set the API endpoint and parameters
    //     $endpoint = 'https://maps.googleapis.com/maps/api/place/textsearch/json';
    //     $params = [
    //         'query' => 'barber+salon+spa|beauty+salon+spa',
    //         'key' => $googleMapsApiKey
    //     ];

    //     // Send a GET request to the API
    //     $response = Http::get($endpoint, $params);

       
    //     // Check if the response was successful
    //     if ($response->successful()) {
    //         // Get the JSON data from the response
    //         $data = $response->json();
            
    //     echo "<pre>";
    //     print_r($data);
    //     die();
    //         // Loop through the results and extract the relevant data
    //         foreach ($data['results'] as $result) {
    //             $name = $result['name'];
    //             $address = $result['formatted_address'];
    //             $latitude = $result['geometry']['location']['lat'];
    //             $longitude = $result['geometry']['location']['lng'];

    //             // Do something with the data, e.g. save it to a database
    //         }
    //     } else {
    //         // Handle the error
    //         $error = $response->json()['error_message'];
    //         die('ssss');
    //         // ...
    //     }

    //     try {
    //         // $googleMaps = new GoogleMaps($googleMapsApiKey);
      
    //         $params = [
    //             'query' => 'barber OR beauty salon',
    //             'type' => 'establishment',
    //             'location' => '31.5203696,74.35874729999999', // your location coordinates
    //             'radius' => 1000, // search radius in meters
    //         ];

    //         $response = \GoogleMaps::load('geocoding')->setParam($params)->get();

           

    //         $results = $googleMaps->load('placeautocomplete')->setParam($params)->get();

    //         $salons = [];

    //         foreach ($results['predictions'] as $prediction) {
    //             $placeDetails = $googleMaps->load('placedetails')->setParam(['placeid' => $prediction['place_id']])->get();

    //             $salons[] = [
    //                 'name' => $placeDetails['result']['name'],
    //                 'address' => $placeDetails['result']['formatted_address'],
    //                 'latitude' => $placeDetails['result']['geometry']['location']['lat'],
    //                 'longitude' => $placeDetails['result']['geometry']['location']['lng'],
    //                 'rating' => $placeDetails['result']['rating'],
    //                 'types' => $placeDetails['result']['types'],
    //             ];
    //         }


    //         return response()->json($salons);
    //     } catch (Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    
    public function getSocialLoginUserInfo(Request $request){
       
        if($request->plateform == 'facebook'){
            $user = Socialite::driver('facebook')->userFromToken($request->token);
        }else{
            $user = Socialite::driver('google')->userFromToken($request->token);
        }

        $name = $user->name;
        $email = $user->email;
        $social_platform = 'Google';
        $social_platform_id = $user->id;
        $device_type = 'web';
        $device_token = $request->token;
        $avatar=$user->avatar;
       
        if (User::where('social_platform_id', $social_platform_id)->where('social_platform', $social_platform)->exists()) {
      
                User::where('social_platform_id', $social_platform_id)->where('social_platform', $social_platform)
                    ->update([
                        'name' => $name,
                        'device_type' => $device_type,
                        // 'device_token' => $device_token,
                        'social_platform' => $social_platform,
                        'social_platform_id' => $social_platform_id,
                    ]);

                $user = User::where('social_platform_id', $social_platform_id)->where('social_platform', $social_platform)->first();
                $isNew =false;
            } else {
   
                $isNew =false;
                if (User::where('email', $email)->exists()) {
                   
                    $user = User::where('email', $email)->update([
                        'name' => $name,
                        'device_type' => $device_type,
                        // 'device_token' => $device_token,
                        'social_platform' => $social_platform,
                        'social_platform_id' => $social_platform_id,
                    ]);
                    $user = User::where('email', $email)->first();
                } else {
                   
                    $contents = file_get_contents($avatar);
                    // $Image_name = substr($avatar, strrpos($avatar, '/') + 1);
                    $Image_name =$name.'-'.$social_platform.'-avatar';
                    $full_name=$Image_name.'.jpg';
                  
                    Storage::disk('uploads')->put($full_name, $contents);
                  
                    $isNew =true;
                    $user = User::Create([
                        'name' => $name,
                        'email' => $email,
                        'device_type' => $device_type,
                        // 'device_token' => $device_token,
                        'social_platform' => $social_platform,
                        'social_platform_id' => $social_platform_id,
                        'role_id' => 3,
                        // 'switchProfile' => 0,
                        'avatar_path' => $full_name,
                        'is_verified' => 1,
                        'status' => 1,
                    ]);
                }
            }
            if ($user) {


                $jwt_token=JWTAuth::fromUser($user);
    
                $token = $jwt_token;

                $data['name'] = $user->name;
                $data['email'] = $user->email;
                $data['role'] = $user->role->name;
                $data['is_shop'] = false;
                $data['avatar'] = $user->avatar_path;
                
                return response()->json([
                    'success' => true,
                    'token' => $jwt_token,
                    'data' => $data,
                ]);

            }
            
            return response()->json([
                'success' => false,
                'message' => 'Invalid Credentials or token',
            ], 401);
           

    }
    public function handleGoogleCallback()
    {
        try {
           
            $user = Socialite::driver('google')->stateless()->user();

            return redirect(\config('app.FRONT_END_BASE_PATH').'/auth/?plateform=google&token='.$user->token);
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function handleFacebookCallback()
    {
        try {
           
            $user = Socialite::driver('facebook')->stateless()->user();

            return redirect(\config('app.FRONT_END_BASE_PATH').'/auth/?plateform=facebook&token='.$user->token);
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function submitContactUs(Request $request){

        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send the email
        Mail::to('hammadrazaa32@gmail.com')->send(new ContactFormMail(
            $request->name,
            $request->email,
            $request->message
        ));

        return response()->json([
                    'success' => true,
                    'message' => 'Your message has been sent successfully!',
                    
                ]);
        // Redirect back or show a success message to the user
        // return redirect()->back()->with('success', 'Your message has been sent successfully!');
   
    }
}