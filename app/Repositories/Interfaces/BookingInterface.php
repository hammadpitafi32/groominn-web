<?php
namespace App\Repositories\Interfaces;

interface BookingInterface
{
    public function create();
    public function getEstimatedTime();
    public function getBookings();
    public function bookingDetail();
    public function bookingCancel();
    public function getUserEarning();
}