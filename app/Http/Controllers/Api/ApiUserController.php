<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserInterface;

class ApiUserController extends Controller
{
    protected $user;
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
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
