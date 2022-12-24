<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CategoryTrait;
use App\Models\Category;
use App\Models\UserService;
use App\Models\UserBusinessCategoryService;

class AdminController extends Controller
{
    use CategoryTrait;

    public function index()
    {
        
        return view('admin.index');
    }

    public function providerList()
    {
        return view('admin.users.index');
    }

    public function getCategories()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));

    }

    public function getServices()
    {
        $services = UserService::with('business_service.user_category','user')->orderBy('id')->get();
        $categories = Category::all();

        return view('admin.service.index',compact('services','categories'));

    }

    public function changeServiceStatus(Request $request)
    {
        $service = UserService::find($request['id']);
        $service->status = ($service->status?0:1);
        
        $service->save();
        
        
        return response()->json([
            'success' => 200,
            'data' => $service
        ]);
    }
    public function updateService(Request $request){

        $service = UserService::find($request['id']);
        $service->name =$request->name;
        $service->save();
        $catServices=UserBusinessCategoryService::where('user_service_id',$request['id'])->update(['charges'=>$request->charges,'duration'=>$request->duration]);

        $services = UserService::with('business_service.user_category','user')->orderBy('id')->get();
        $categories = Category::all();
        return view('admin.service.index',compact('services','categories'));
    }
}
