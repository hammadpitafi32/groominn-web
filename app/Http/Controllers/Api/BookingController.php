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
        return $this->booking->create();
    }

    public function getEstimatedTime(Request $request)
    {
        $data = $this->booking->getEstimatedTime();
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function getBookings(Request $request)
    {
        return $this->booking->getBookings();

    }
    public function bookingDetail(Request $request)
    {
        return $this->booking->bookingDetail();

    }
    public function bookingCancel(Request $request)
    {
        return $this->booking->bookingCancel();

    }

    public function getUserEraning(Request $request)
    {
        return $this->booking->getUserEraning();

    }
}
