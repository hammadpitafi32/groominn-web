<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CategoryTrait;
use App\Models\Category;
use App\Models\UserService;
use App\Models\UserBusinessCategoryService;
use App\Models\UserBusiness;
use App\Models\BusinessType;

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

    public function businessDelete(Request $request){

        $business = UserBusiness::find($request['id']);
        
        if($business){
            $business->delete();
            
            return response()->json([
                'success' => 200,
                'data' => $business
            ]);
        }
        return response()->json([
            'success' => 400,
            'data' => $business
        ]);
        
        
    }

    public function getBusinessTypes(Request $request){
        
        $types=BusinessType::get();
        return view('admin.businessType.index',compact('types'));
    }

    public function createBusinessType(Request $request){

        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);
        
        $data=['name'=>$request->name,'image'=>$request->image];
        
        $type=BusinessType::create($data);

        return response()->json([
                'success' => 200,
                'data' => $type
            ]);
    }
    public function updateBusinessType(Request $request){

        $request->validate([
            'id' => 'required',
        ]);
        $type = BusinessType::find($request['id']);
        $type->name =$request->name;
        $type->image =$request->image;
        $type->save();
        return response()->json([
                'success' => 200,
                'data' => $type
            ]);
    }
    public function deleteBusinessType(Request $request){
        
        $type = BusinessType::find($request['id']);
        
        if($type){
            $type->delete();
            
            return response()->json([
                'success' => 200,
                'data' => $type
            ]);
        }
        return response()->json([
            'success' => 400,
            'data' => $type
        ]);
    }
}
