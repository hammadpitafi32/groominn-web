<?php
namespace App\Repositories;
use App\Repositories\Interfaces\UserBusinessInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Auth;
use File;
use Carbon\Carbon;

use App\Helpers\UploadImageHelper;

use App\Models\UserBusiness;
use App\Models\UserBusinessSchedule;
use App\Models\UserBusinessImage;
use App\Traits\ServiceTrait;

use App\Models\UserBusinessCategoryService;
class UserBusinessRepository implements UserBusinessInterface
{
	use ServiceTrait;

	protected $user_business;
	protected $request;


	public function __construct(UserBusiness $user_business,Request $request)
	{
		$this->user_business = $user_business;
		$this->request = $request;
	}

	public function find($id)
    {
        return $this->user_business
        ->with('user_business_images','user_business_schedules','user_categories','user_categories.user_business_category_services','user_categories.user_business_category_services.user_service')
  //       ->with(['user_categories' => function ($query) {
		//         // $query->select('id','user_id', 'name');
		//     }],'user_categories.user_business_category_services'
		//    //  ['user_categories.user_business_category_services' => function ($query) {
	 //    //     // $query->select('id','user_id', 'name');
	 //    // }]
		// )
        ->find($id);


        return $this->user_business->with('user_business_images','user_business_schedules','user_business_category_services','user_business_category_services.user_category','user_business_category_services.user_service','user_categories')->find($id);
    }

	public function createOrUpdate()
	{
		$request = $this->request;
		$validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'address' => 'required',
            'cnic_front' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'cnic_back' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
            'license' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }
		
		$user_business = $request->id ? $this->find($request->id) : $this->user_business;
		if (!$request->id) 
		{
			if ($this->user_business->where('user_id',Auth::id())->count() > 0) 
			{
				return response()->json([
					'success' => false,
					'message' => 'You already have business, please contact support!'
				]);
			}
			
			
		}
		$user_business->user_id = Auth::id();
		$user_business->name = $request->name;
        $user_business->description = $request->description;
        $user_business->address = $request->address;
        $user_business->city = $request->city;
        $user_business->state_id = $request->state_id;
        $user_business->country_id = $request->country_id;
        $user_business->latitude = $request->latitude;
        $user_business->longitude = $request->longitude;
        $user_business->save();
        /*images*/
        $file_path = 'uploads/user/'.Auth::id().'/business/'.$user_business->id.'/';
        $path = public_path($file_path);

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        if (isset($request->cnic_front))
        {
            $file =$request->cnic_front;
            $cnic_front = UploadImageHelper::upload($file,$path,@$user_business);
            $user_business->cnic_front = $file_path.$cnic_front;
        }

        if (isset($request->cnic_back))
        {
            $file =$request->cnic_back;
            $cnic_back = UploadImageHelper::upload($file,$path,@$user_business);
            $user_business->cnic_back = $file_path.$cnic_back;
        }

        if (isset($request->license))
        {
            $file =$request->license;
            $license = UploadImageHelper::upload($file,$path,@$user_business);
            $user_business->license = $file_path.$license;
        }
        /*required images*/
        $user_business->save();
        /*end*/

        /*shop images*/
        if (isset($request->shop_images))
        {
        	$file_path = 'uploads/user/'.Auth::id().'/business/'.$user_business->id.'/catalog/';
        	$path = public_path($file_path);

	        if (!File::isDirectory($path)) {
	            File::makeDirectory($path, 0777, true, true);
	        }
	        // if (count($request->shop_images) > 0) 
	        // {
	        	foreach ($request->shop_images as $file) 
	        	{
		            $file_name = UploadImageHelper::upload($file,$path,@$user_business);
		            UserBusinessImage::create([
		            	'user_business_id' => $user_business->id,
		            	'name' => $file_path.$file_name
		            ]);
		        }
	        // }
        	
        }

        return response()->json([
            'success' => true,
            'data' => $user_business
        ], 200);
	}

	public function createOrUpdateSchedule()
	{
		$request = $this->request;
		$user_business_id = $request->user_business_id;
		$user_business = $this->user_business->find($user_business_id);
		$existing_days = $user_business->user_business_schedules->pluck('day')->toArray();
		$new_days = [];
		$date = Carbon::now('+13:30');
  
		foreach ($request->days as $key => $schedule)
		{
			$day = date('l',strtotime($key));
			$new_days[] = $day;
			// dd(date('l'));
			UserBusinessSchedule::updateOrCreate([
					'user_business_id' => $user_business->id,
					'day' => $day
				],
				[
					'open_at' => date('H:i',strtotime($schedule['open_at'])),
					'close_at' => date('H:i',strtotime($schedule['close_at'])),
				]
			);
		}
		/*delete if exist but not selected*/
		$delete_days = array_diff($existing_days,$new_days);
		$this->user_business->find($user_business_id)->user_business_schedules()->whereIn('day',$delete_days)->delete();

		return [
        	'success' => 200,
        	'data' => $user_business
        ];
		
	}

	public function createUserBusinessService()
	{
		$request = $this->request;
		$user_business_cat_service = $request->id ?  UserBusinessCategoryService::find($request->id) : new UserBusinessCategoryService;

		if (!$user_business_cat_service) {
			 return response()->json([
                'success' => false,
                'message' => 'Service not found!',
            ], 400);
		}

		$user_business_id = $request->user_business_id?:Auth::user()->user_business->id;

		// dd($user_business_id);

		// dd($user_business_cat_service->user_service_id,$request->all());
		$request['name'] = $request->service;
		$request['service_id'] = $user_business_cat_service->user_service_id;
		// dd(date('H:i'));
		$validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => ['required',
                Rule::unique('user_services')->where(function ($query) use ($request) {
                    return $query->where('id','!=',$request->service_id)->where('user_id', Auth::id())->where('name',$request->name)->whereNull('deleted_at');
                })
            ],
            'duration' => ['required','date_format:H:i'],
            'charges' => 'required',
            'type' => 'required',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        }
		// dd(Auth::user()->user_business);
		// dd($request->all());
		
		// dd($user_business_cat_service);
		$user_business_cat_service->user_business_id = $user_business_id;
		$user_business_cat_service->user_category_id = $request->category_id;
		/*creating service if not exist*/
		$service = $this->createOrUpdateService($request);
		/*end*/
		$user_business_cat_service->user_service_id = $service->id;
		$user_business_cat_service->duration = $request->duration;
		$user_business_cat_service->charges = $request->charges;
		$user_business_cat_service->type = $request->type;
		$user_business_cat_service->save();


		return response()->json([
            'success' => true,
            'data' => $user_business_cat_service
        ], 200);

	}

	public function getUserBusiness($id)
	{
		$id =  $id?:((Auth::user()->user_business && Auth::user()->user_business->id)?Auth::user()->user_business->id:null);
		// dd($id);
		$business = $this->find($id);

		// dd($business->user_categories,Auth::id());
		// $business['cnic_front'] = asset($business->cnic_front);
		// $business['cnic_back'] = asset($business->cnic_back);
		// $business['license'] = asset($business->license);

		return response()->json([
            'success' => true,
            'data' => $business
        ], 200);
	}

	public function deleteUserBusiness($id)
	{
		$id = $id?:((Auth::user()->user_business && Auth::user()->user_business->id)?Auth::user()->user_business->id:null);

		$business = $this->find($id);
		if ($business) 
		{
			$business->delete();
		}
		else
		{
			// $business = UserBusiness::withTrashed()->find(7);
			// // dd($business,$id);
			// $business->restore();
			return response()->json([
	            'success' => false,
	            'message' => 'User business not found!'
	        ], 400);
		}
		return response()->json([
            'success' => true,
            'message' => 'User business deleted successfully!'
        ], 200);

	}

	public function deleteUserCategoryService($id)
	{
		$user_category_service = UserBusinessCategoryService::find($id);
		if ($user_category_service) 
        {
            $user_category_service->delete();
            return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully!'
        ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Service not found!'
        ], 400);
        
        
	}

	public function getBusinesseslist()
	{
		$request = $this->request;
		$user_business = UserBusiness::with('user_business_images','user_business_schedules','user_business_category_services','user_business_category_services.user_category','user_business_category_services.user_service','user_categories');
        if ($request->pagination == 'false') 
        {
            $user_business= $user_business->get();
        }
        else
        {
            $user_business =$user_business->paginate(10);
        }

        return response()->json([
            'success' => true,
            'data' => $user_business
        ], 200);
	}

}