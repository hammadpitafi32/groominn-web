<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserInterface;
use App\Models\Role;
use App\Traits\UserTrait;

class UserController extends Controller
{
    use UserTrait;
    protected $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function createOrUpdate(Request $request)
    {
        // dd($request->all());
        return $this->createOrUpdateUser($request);
    }

    public function list($role)
    {
        $roles = Role::all();
        $users = $this->user->list($role);

        return view('admin.users.index',compact('users','roles'));
    }

}
