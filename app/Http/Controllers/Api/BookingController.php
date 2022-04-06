<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\BookingInterface;

class BookingController extends Controller
{
    protected $booking;
    public function __construct(BookingInterface $booking)
    {
        $this->booking = $booking;
    }

    public function create(Request $request)
    {
        dd($this->booking->create());
        $response = $this->user_business->createOrUpdate();
        
        return response()->json([
         'success' => $response['success'],
         'data' => $response['data']
        ]);
    }

    public function getEstimatedTime(Request $request)
    {
        dd($this->booking->getEstimatedTime());
    }
}
