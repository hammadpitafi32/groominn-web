<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CategoryTrait;
use App\Models\Category;
use App\Models\UserService;

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
        $services = UserService::orderBy('id')->get();
        // dd($services);
        return view('admin.service.index',compact('services'));

    }

    public function changeServiceStatus(Request $request)
    {
        $service = UserService::find($request['id']);
        $service->status = ($service->status?0:1);
        // dd($service);
        $service->save();

        return response()->json([
            'success' => 200,
            'data' => $service
        ]);
    }
}
