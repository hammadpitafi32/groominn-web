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
        return UserCategory::find($request->id);
    }

    public function createOrUpdateCategory(Request $request)
    {
        
        $user_category = $request->id ?  UserCategory::find($request->id) : new UserCategory;

        if ($request->id && $user_category == null) 
        {
            return;
        }
        $user_category->user_id = Auth::id();
        $user_category->name = $request->name;
        $user_category->save();
        
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
        

        return $user_category->only('id','name');
    }

    public function userCategories($request)
    {
        $user_categories = UserCategory::select('id','name')->where('user_id',Auth::id());
        // dd($request->all());
        if ($request->pagination == 'false') 
        {
            $user_categories= $user_categories->get();
        }
        else
        {
            $user_categories =$user_categories->paginate(10);
        }
        // dd($user_categories);

        return $user_categories;
        
    }

    public function deleteCategory($id)
    {
        $category = $this->findCategory($id);
        dd($category);
    }
  
}