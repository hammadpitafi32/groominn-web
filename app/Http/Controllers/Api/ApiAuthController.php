<?php
 
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use App\Traits\UserTrait;
use Auth;
class ApiAuthController extends Controller
{

    use UserTrait;
    public $loginAfterSignUp = true;
 
    public function register(Request $request)
    {
        $response = $this->createOrUpdateUser($request);
        if ($response && $response->getStatusCode() == 400) {
            return $response;
        }
        // dd(json_decode($response->getContent(), true));
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
        return $response;
    }
 
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
 
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        $user = Auth::user();
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['role'] = $user->role->name;
        $data['is_shop'] = ($user->user_business && $user->user_business->id?true:false);
        
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


    
}