<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;

use App\Models\UserService;
use App\Models\UserBusinessCategoryService;
use Auth;
trait ServiceTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function createOrUpdateService(Request $request)
    {

        $user_service = $request->id ?  UserService::find($request->id) : new UserService;

        if ($request->id && $user_service == null) 
        {
            return;
        }
        $user_service->user_id = Auth::id();
        $user_service->name = $request->service;
        $user_service->save();
        return $user_service;
    }

    public function UserServices()
    {
        // dd(Auth::user());
        return UserBusinessCategoryService::with('user_category','user_service')->where('user_business_id',Auth::user()->user_business->id)->get();
    }
  
}