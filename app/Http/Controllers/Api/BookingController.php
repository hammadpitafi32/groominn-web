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
        return $this->booking->getEstimatedTime();
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
}
