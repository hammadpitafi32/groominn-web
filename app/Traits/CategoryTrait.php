<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\UserCategory;
use Auth;
trait CategoryTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function findCategory($id)
    {
        return UserCategory::with('user_business_category_services')->find($id);
    }

    public function createOrUpdateCategory(Request $request)
    {

        $category = $request->id ?  Category::find($request->id) : new Category;

        if ($request->id && $category == null) 
        {
            return;
        }
        $category->name = $request->name;
        $category->save();
        /*previous logic user can add or update categories (now revoke)*/
        // $user_category = $request->id ?  UserCategory::find($request->id) : new UserCategory;

        // if ($request->id && $user_category == null) 
        // {
        //     return;
        // }
        // $user_category->user_id = Auth::id();
        // $user_category->name = $request->name;
        // $user_category->save();
        
        /*bind with business*/
        // BusinessCategory::updateOrCreate([
        //         'business_id' => $request->business_id?:1,
        //         'category_id' => $category->id
        //     ],
        //     [
        //         'business_id' => $request->business_id?:1,
        //         'category_id' => $category->id
        //     ]
        // );
        // if (Auth::user()->role->name == 'Provider') 
        // {
        //     UserCategory::updateOrCreate([
        //             'user_id' => Auth::id(),
        //             'category_id' => $category->id
        //         ],
        //         [
        //             'user_id' => Auth::id(),
        //             'category_id' => $category->id
        //         ]
        //     );
        // }
        

        return $category->only('id','name');
    }

    public function userCategories($request)
    {
        $user_categories = UserCategory::with('category')
        // ->select('id','categories.name')
        ->where('user_id',Auth::id());
        if ($request->pagination == 'false') 
        {
            $user_categories= $user_categories->get();
        }
        else
        {
            $user_categories =$user_categories->paginate(10);
        }
        // dd($user_categories->first()->category->name);
        return $user_categories;
        
    }

    public function deleteCategory($id)
    {
        $category = $this->findCategory($id);
        // dd($category->user_business_category_services);
        if ($category) 
        {
            $category->delete();
        }
        else
        {
            // $business = UserBusiness::withTrashed()->find(7);
            // // dd($business,$id);
            // $business->restore();
            return response()->json([
                'success' => false,
                'message' => 'User category not found!'
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => 'User category deleted successfully!'
        ], 200);
    }


    public function bindCategoriesToUser(Request $request)
    {
        dd('sdf');
        $categories = Category::whereIn('id',$request->category_ids)->get();
        if ($categories->count() > 0) 
        {
            if ($request->action == 'bind') 
            {
                foreach ($categories as $category) {
                    $user_category = UserCategory::updateOrCreate([
                        'category_id' => $category->id,
                        'user_id' => Auth::id()
                    ],
                    [
                        'category_id' => $category->id,
                        'user_id' => Auth::id()
                    ]);
                }
            }

            if ($request->action == 'remove') 
            {

                UserCategory::whereIn('category_id',$request->category_ids)->where('user_id',Auth::id())->delete();
            }
        }
        

        return $this->userCategories($request);
    }

    /*admin access for now*/
    public function getAllCategories()
    {
        return Category::all();
    }
  
}