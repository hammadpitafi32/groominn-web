<?php
  
namespace App\Traits;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\BusinessCategory;
  
trait CategoryTrait {
  
    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function createOrUpdateCategory(Request $request)
    {
        
        $category = $request->id ?  Category::find($request->id) : new Category;

        $category = $category->updateOrCreate([
                'name' => $request->name
            ],
            [
                'name' => $request->name
            ]
        );
        /*bind with business*/
        BusinessCategory::updateOrCreate([
                'business_id' => $request->business_id?:1,
                'category_id' => $category->id
            ],
            [
                'business_id' => $request->business_id?:1,
                'category_id' => $category->id
            ]
        );

        return $category;
    }

    public function userCategories()
    {
        return Category::select('id','name')->paginate(1);
        // dd($categories);
        // retrun $categories;
    }
  
}