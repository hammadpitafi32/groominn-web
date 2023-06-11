<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserBusinessInterface;
use App\Models\UserBusiness;
use App\Models\BusinessHour;
use App\Models\BusinessDay;
use App\Traits\CategoryTrait;
use App\Traits\ServiceTrait;
use App\Models\BusinessType;
use App\Models\Notification;
use View;

class UserBusinessController extends Controller
{
    use CategoryTrait;
    use ServiceTrait;

    protected $user_business;
    protected $Listnotifications;
    public function __construct(UserBusinessInterface $user_business)
    {
        $this->user_business = $user_business;
        $this->Listnotifications = Notification::latest()->take(8)->get();

        View::share('Listnotifications', $this->Listnotifications);
    }

    public function createOrUpdate(Request $request)
    {

        return $this->user_business->createOrUpdate();

    }

    public function getUserBusiness($id=null)
    {
        return $this->user_business->getUserBusiness($id);

    }

    public function getShopInfo(Request $request)
    {
     
        return $this->user_business->getUserBusiness($request->id);

    }

    public function createOrUpdateSchedule(Request $request)
    {
        
        $response = $this->user_business->createOrUpdateSchedule();
        return response()->json([
            'success' => $response['success'],
            'data' => $response['data']
        ]);
    }

    public function createUserBusinessService(Request $request)
    {

        return $this->user_business->createUserBusinessService();
    }

    public function getUserCategories(Request $request)
    {
        
        $categories = $this->userCategories($request);

        return response()->json([
            'success' => true,
            'data' => $categories
        ], 200);
    }

    public function getUserServices(Request $request)
    {
        
        $services = $this->userServices($request);

        return response()->json([
            'success' => true,
            'data' => $services
        ], 200);
    }

    public function deleteUserBusiness($id=null)
    {
        return $this->user_business->deleteUserBusiness($id);

    }

    public function deleteUserCategory($id)
    {
        return $this->deleteCategory($id);
    }

    public function deleteUserService($id)
    {
        return $this->user_business->deleteUserCategoryService($id);
    }

    public function getBusinesseslist(Request $request)
    {

        return $this->user_business->getBusinesseslist();
    }

    public function deleteBusinessImage(Request $request)
    {
       
        return $this->user_business->deleteBusinessImage();
    }

    public function getCategories(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $this->getAllCategories()
        ], 200);
       
    }

    public function getAllBusinesses(Request $request)
    {
       
        $user_businesses = $this->user_business->all();

        return view('admin.business.index',compact('user_businesses'));
    }

    public function changeBusinessStatus(Request $request)
    {
        return $this->user_business->changeStatus();

    }
    // public function deleteCategory(Request $request)
    // {

    //     return $this->delCategory($request->id);

    // }
    public function ServiceDelete(Request $request){
      
        return $this->deleteService($request->id);
    }
    public function addShopSchedule(Request $request){

        $validator = Validator::make($request->all(), [
            'is_open' => 'required',
            // 'business_days_to' => 'required',
            // 'form_time_span' => "required",
            'from_time' => "required",
            // 'to_time_span' => "required",
            'to_time' => "required",

        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'errors' => $validator->messages(),
                'success' => false
            ], 400);
        
        }

        $data=[
            'business_days_id'=>0,
            // 'is_open'=>$request->is_open,
            'user_businesses_id'=>auth()->user()->user_business->id,
            'start_time'=>$request->from_time,
            'end_time'=>$request->to_time,
        ];
        
        BusinessHour::updateOrCreate(['user_businesses_id'=>auth()->user()->user_business->id],$data);

        if($request->has('is_open')){
            UserBusiness::find(auth()->user()->user_business->id)->update(['is_open'=>$request->is_open]);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
       
    }

    public function getBusinessTypes(Request $request){
        
        $types=BusinessType::with('businesses')->get();
        // echo "<pre>";
        // print_r($types->toarray());
        // die();
        return response()->json([
            'success' => true,
            'data' => $types
        ], 200);
    }
    
}
