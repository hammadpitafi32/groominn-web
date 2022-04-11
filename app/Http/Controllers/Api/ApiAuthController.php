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
class ApiAuthController extends Controller
{

    use UserTrait;
    public $loginAfterSignUp = true;
 
    public function register(Request $request)
    {
        // dd('dfg');
        //Validate data
        // $data = $request->only('name', 'email', 'password','role','phone');
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50|confirmed',
            'phone' => 'required',
            'role' => 'required'
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $role =Role::where('name',$request->role)->first();
        // dd($role);
        if ($role && $role->name == 'Admin') {
            return response()->json(['error' => ['role' => 'Cannot add user against this role!']], 200);
        }
        elseif(!$role)
        {
            return response()->json(['error' => ['role' => 'Role Not found!']], 200);
        }
        $request['role_id'] = $role->id;
        $request['name'] = $request->first_name.' '.$request->last_name;
        // dd($request->all());
        $user = $this->createOrUpdateUser($request);
 
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
 
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
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
 
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
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
            return response()->json(['error' => $validator->messages()], 200);
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
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }
}