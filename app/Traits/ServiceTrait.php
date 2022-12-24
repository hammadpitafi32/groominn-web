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
    public function findService($id)
    {
        return UserService::find($id);
    }

    public function serviceFindBy($column,$value)
    {
        return UserService::where('user_id', Auth::id())->where($column,$value);
    }

    public function createOrUpdateService(Request $request)
    {
        // dd($request->all());
        $user_service = $request->service_id ?  UserService::find($request->service_id) : new UserService;

        if ($request->service_id && $user_service == null) 
        {
            return;
        }
        $user_service->user_id = Auth::id();
        $user_service->name = $request->service;
        $user_service->save();
        return $user_service;
    }

    public function userServices($request)
    {
        // dd(Auth::user());
        $user_services = UserBusinessCategoryService::with('user_category','user_category.category','user_service')->where('user_business_id',Auth::user()->user_business->id);
        if ($request->pagination == 'false') 
        {
            $user_services= $user_services->get();
        }
        else
        {
            $user_services =$user_services->paginate(10);
        }
        return $user_services;
    }

    public function deleteService($id)
    {
        $service = $this->findService($id);
       
        if ($service) 
        {
            $service->delete();
        }
        else
        {
 
            return response()->json([
                'success' => false,
                'message' => 'User Service not found!'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'User Service deleted successfully!'
        ], 200);
    }
  
}