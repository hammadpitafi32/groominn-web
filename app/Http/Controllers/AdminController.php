<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CategoryTrait;
use App\Models\Category;
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
}
