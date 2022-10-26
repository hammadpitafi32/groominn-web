<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Role;

use Auth;
use App\Rules\MatchOldPassword;

use App\Notifications\RegisterNotification;
use App\Notifications\OtpNotification;

trait UserTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function validation($request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => "required|unique:users,email,{$request->id}",
            'phone' => 'required',
        ]);
       
        if ($request->id && $request->current_password) 
        {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', new MatchOldPassword],
                'password' => 'required|string|min:6|max:50|confirmed',
            ]);
        }
        if(!$request->id)
        {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|max:50|confirmed',
                'phone' => 'required',
                'role' => 'required'
            ]);

            $role = Role::where('name',$request->role)->first();

            if ($role && $role->name == 'Admin' && Auth::user()->role->name != 'Admin') {
                return response()->json([
                    'errors' => ['role' => ['Cannot add user against this role!']],
                    'success' => false
                ], 400);
            }
            elseif(!$role)
            {
                return response()->json([
                    'errors' => ['role' => ['Role Not found!']],
                    'success' => false
                ], 400);
            }
        }
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }
        /*validation end*/
        
    }
    public function createOrUpdateUser(Request $request)
    {
        $response = $this->validation($request);
        // dd($response);
        if ($response && $response->getStatusCode() == 400) {
            return $response;
        }
        // dd('gg');
        $user = ($request->id ?  User::find($request->id) : new User);
        if(!$request->id)
        {
            $role = Role::where('name',$request->role)->first();
        }
        else{
            $role = $user->role;
        }

        $request['role_id'] = $role->id;
        $request['name'] = $request->first_name.' '.$request->last_name;

        // dd($request->password);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->added_by = $request->added_by;
        if (@$request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();


        // $user = $user->updateOrCreate(
        //     [
        //         'email' => $request->email,
        //     ],
        //     [
        //         'name' => $request->name,
        //         // 'password' => Hash::make($request->password),
        //         'role_id' => $request->role_id,
        //         'added_by' => $request->added_by,
        //     ]
        // );


        $user->user_detail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'country_id' => $request->country_id,
                'state_id'  =>  $request->state_id,
                'city'  =>  $request->city,
                'zip_code'  =>  $request->zip_code,
                'tax_id' => $request->tax_id
            ]
        );

        if(!$request->id)
        {
            // $user->notify(new RegisterNotification());
        }
        if (!$user->is_verified) 
        {
            return response()->json([
                'success' => true,
                'data' => $user,
                'action_require' => true

            ], 201);
        }
    
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    public function generateOtp($request)
    {
        $code = rand(1000, 9999); //generate random code
        $request['code'] = $code; //add code in $request body
        $user = User::where('email',$request['email'])->first();

        $user->two_factor_code = $code;
        $user->is_verified = false;
        $user->save();

        return $user;
    }
    public function verifyEmailOtp($request)
    {
        $user = User::where('email',$request['email'])->first();

        if ($user) {
            if ($user->two_factor_code == $request['code']) 
            {
                $user = tap($user)->update([
                    'two_factor_code' => null,
                    'is_verified' => true
                ]);

                return [
                    'success' => true,
                    'user' => $user
                ];
            }
            else{
                return [
                    'success' => false,
                    'message' => 'Invalid verification code entered!',
                    'action_require' => true
                ];
            }
        }
        else
        {
            return [
                'success' => false,
                'message' => 'User Not found',
                'action_require' => true
            ];
        }
    }
  
}