<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

trait UserTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function createOrUpdateUser(Request $request)
    {
        // $request = $this->request;
        // $user = $request->id ?  $this->user->find($request->id) : $this->user;

        $user = User::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'added_by' => $request->added_by,
            ]
        );

        $user->user_detail()->updateOrCreate(
            [
                'user_id'=>$user->id,
            ],
            [
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'date_of_birth'=>$request->date_of_birth,
                'address_line_1'=>$request->address_line_1,
                'address_line_2'=>$request->address_line_2,
                'country_id'=>$request->country_id,
                'state_id' => $request->state_id,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'tax_id'=>$request->tax_id
            ]
        );
        return $user;
    }
  
}