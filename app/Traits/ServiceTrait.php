<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\UserBusinessCategoryService;
use Auth;
trait ServiceTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function createOrUpdateService(Request $request)
    {
        $service = Service::updateOrCreate([
            'name' => $request->service,
        ]);
        return $service;
    }

    public function UserServices()
    {
        return UserBusinessCategoryService::with('category','service')->where('user_business_id',Auth::user()->user_business->id)->get();
    }
  
}