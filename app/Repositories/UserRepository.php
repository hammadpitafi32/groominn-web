<?php
namespace App\Repositories;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserRepository implements UserInterface
{
	protected $user;
	protected $request;
	public function __construct(User $user,Request $request)
	{
		$this->user = $user;
		$this->request = $request;
	}
	public function find($id)
    {
        return $this->user->findOrfail($id);
    }

	public function createOrUpdate()
	{
		$request = $this->request;
        $user = $request->id ?  $this->user->find($request->id) : $this->user;

		$user = $this->user->updateOrCreate(
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
		// dd($this->request->all(),$request->role_id);
		return $user;
		// return response()->json([
		// 	'success' => 200,
		// 	'user' => $user
		// ]);
	}

	public function list($role)
	{
		return $this->user->whereHas('role',function($q) use($role){
			$q->where('name',$role);
		})->get();

		// return response()->json([
		// 	'success' => 200,
		// 	'users' => $users
		// ]);
	}
}