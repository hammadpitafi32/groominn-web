<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserInterface;
use App\Models\Role;
class UserController extends Controller
{
    protected $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function createOrUpdate(Request $request)
    {
        // dd($this->user->createOrUpdate());
         $this->user->createOrUpdate();
         return back();
    }

    public function list($role)
    {
        $roles = Role::all();
        $users = $this->user->list($role);

        return view('admin.users.index',compact('users','roles'));
    }

}
