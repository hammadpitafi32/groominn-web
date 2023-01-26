<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserInterface;
use App\Models\Role;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Notification;
use View;


class UserController extends Controller
{
    use UserTrait;
    protected $user;
    protected $Listnotifications;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
        $this->Listnotifications = Notification::latest()->take(8)->get();

        View::share('Listnotifications', $this->Listnotifications);
    }

    public function createOrUpdate(Request $request)
    {
       
        return $this->createOrUpdateUser($request);
    }

    public function list($role)
    {
    
        $roles = Role::all();
        $users = $this->user->list($role);
        $users->load('user_detail');
        $users->load('role');
        // echo "<pre>";
        // print_r($users->toarray());
        // die();
        return view('admin.users.index',compact('users','roles'));
    }
    public function changeUserStatus(Request $request)
    {
        return $this->user->changeStatus();
    }
    
    public function UserDelete(Request $request){
       return $this->deleteUser($request->id);
    }
    public function updateUser(Request $request)
    {

       $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'confirmed',
            'phone' =>'required',
            'role' => 'required'
        ]);
        
        $input=$request->all();
        $role = Role::where('name',$request->role)->first();
        
        if($request->has('password') && $request->password !=''){
           $input['password']=Hash::make($request->password); 
        }else{
            unset($input['password']);
        }
        $input['name']=$request->first_name;
        $input['role_id'] = $role->id;

        $user=User::find($request->id);
        $updateUser = $user->update($input);
        
        if($request->has('phone') &&  $request->phone!=''){
            
            $user->user_detail()->updateOrCreate(
                [
                    'user_id' => $request->id,
                ],
                [
                    'phone' => $request->phone,
                ]
            );
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }
    public function updateProfile(Request $request)
    {

        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user()->id,
            'password' => 'nullable|confirmed|min:6',
            'avatar' => 'nullable|image|max:2048'
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Update the user's name
        $user->name = $request->input('name');

        // Update the user's email
        $user->email = $request->input('email');

        // Update the user's password, if provided
        if ($request->has('password') && $request->password !='') {
            $user->password = bcrypt($request->input('password'));
        }

        // Update the user's avatar, if provided
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_path = $avatar->store('avatars', 'public');
            $user->avatar_path = $avatar_path;
        }

        // Save the updated user
        $user->save();

        // Redirect the user back with a success message
        return redirect()->back()->with('success', 'Your profile has been updated successfully!');
   }
    public function getProfile()
    {
        $roles = Role::all();
        $user = auth()->user();

        return view('admin.profile',compact('user'));
    }

}
