<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Business;
// use App\Models\Category;
use App\Models\BusinessCategory;
// use App\Models\Service;
use App\Models\CategoryService;
use File;
use Auth;
use App\Helpers\UploadImageHelper;
use App\Traits\CategoryTrait;

class BusinessController extends Controller
{
    use CategoryTrait;

    public function __construct()
    {
        // $this->middleware('provider.jwt');
    }
    public function createOrUpdate(Request $request)
    {
        // dd($request->all());
        // $user = $request->id ?  Business::find($request->id) : new Business;

        $business = Business::updateOrCreate(
            [
                'name' => $request->name,
            ],
            [
                'name' => $request->name,
            ]
        );

        return response()->json([
         'success' => 200,
         'business' => $business
        ]);
    }
    public function CreateOrUpdateBusinessCategory(Request $request)
    {
        // dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     // 'name' => ['required','string',
        //     //     Rule::unique('user_categories')->where(function ($query) use ($request) {
        //     //         return $query->where('id','!=',$request->id)->where('user_id', Auth::id())->where('name',$request->name)->whereNull('deleted_at');
        //     //     })
        // ]);

        $validator = Validator::make($request->all(), [
            'name' => "required|unique:categories,name,{$request->id}",
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }

        $category = $this->createOrUpdateCategory($request);

        return response()->json([
            'success' => true,
            'category' => $category
        ],200);
    }


    /*not used remove soon*/
    public function createOrUpdateCaetgoryService(Request $request)
    {
        // dd($request->all());
        $service = Service::updateOrCreate([
                'name' => $request->name
            ],
            [
                'name' => $request->name
            ]
        );

        $data = CategoryService::updateOrCreate([
                'category_id' => $request->category_id,
                'service_id' => $service->id,
            ],
            [
                'category_id' => $request->category_id,
                'service_id' => $service->id,
            ]
        );

        return response()->json([
         'success' => 200,
         'service' => $service
        ]);
    }


    public function bindCategories(Request $request)
    {
        // dd($req)
        $validator = Validator::make($request->all(), [
            'category_ids' => "required",
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }
        $categories = $this->bindCategoriesToUser($request);
        return response()->json([
         'success' => 200,
         'categories' => $categories
        ]);
    }
}
