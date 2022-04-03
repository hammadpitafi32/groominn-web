<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\Service;
use App\Models\CategoryService;
use File;
use App\Helpers\UploadImageHelper;

class BusinessController extends Controller
{
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
        $category = Category::updateOrCreate([
                'name' => $request->name
            ],
            [
                'name' => $request->name
            ]
        );
        $data = BusinessCategory::updateOrCreate([
                'business_id' => $request->business_id,
                'category_id' => $category->id
            ],
            [
                'business_id' => $request->business_id,
                'category_id' => $category->id
            ]
        );

        return response()->json([
         'success' => 200,
         'category' => $category
        ]);
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


    public function CreateOrUpdateUserBusiness(Request $request)
    {
        // dd($request->all());
        $folder = public_path('uploads/user/business');

        if (!File::isDirectory($folder)) {
            File::makeDirectory($folder, 0777, true, true);
        }

        $path = public_path('uploads/user/business');
        if (isset($request->cnic_front))
        {
            $file =$request->cnic_front;
            $cnic_front = UploadImageHelper::upload($file,$path,@$user_business);
            $user_business->cnic_front = $cnic_front;
        }

        if (isset($request->cnic_back))
        {
            $file =$request->cnic_back;
            $cnic_back = UploadImageHelper::upload($file,$path,@$user_business);
            $user_business->cnic_back = $cnic_back;
        }

        if (isset($request->license))
        {
            $file =$request->license;
            $license = UploadImageHelper::upload($file,$path,@$user_business);
            $user_business->license = $license;
        }
        dd('dsf');


        $user_business = UserBusiness::updateOrCreate([
                'name' => $request->name
            ],
            [
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'city' => $request->city,
                'state_id' => $request->state_id,
                'country_id' => $request->country_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'cnic_front' => $request->cnic_front,
                'cnic_back' => $request->cnic_back,
                'license' => $request->license,
            ]
        );


    }



}
