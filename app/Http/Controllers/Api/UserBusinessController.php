<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserBusinessInterface;
use App\Models\UserBusiness;
class UserBusinessController extends Controller
{
    protected $user_business;
    public function __construct(UserBusinessInterface $user_business)
    {
        $this->user_business = $user_business;
    }

    public function createOrUpdate(Request $request)
    {
        $response = $this->user_business->createOrUpdate();
        
        return response()->json([
         'success' => $response['success'],
         'data' => $response['data']
        ]);
    }

    public function createUserBusinessService(Request $request)
    {

        $response = $this->user_business->createUserBusinessService();

        return response()->json([
         'success' => $response['success'],
         'data' => $response['data']
        ]);
    }
}
