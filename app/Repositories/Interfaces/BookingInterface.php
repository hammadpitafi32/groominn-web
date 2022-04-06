<?php
namespace App\Repositories\Interfaces;

interface BookingInterface
{
    public function create();
    public function getEstimatedTime();
}