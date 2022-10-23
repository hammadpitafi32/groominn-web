<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserInterface;
use App\Traits\UserTrait;

class ApiUserController extends Controller
{
    use UserTrait;

    protected $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function createOrUpdate(Request $request)
    {
        // dd($request->all());
        return $this->createOrUpdateUser($request);
    }

    public function saveBankDetail()
    {
        return $this->user->saveBankDetail();
    }

    public function getBankDetail(Request $request)
    {
        return $this->user->getBankDetail();
    }
    public function deleteBankDetail(Request $request)
    {
        return $this->user->deleteBankDetail();
    }
}
