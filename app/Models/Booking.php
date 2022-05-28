<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'booking_no','user_id','user_business_id','total_duration','date','estimated_time','payment_type','charges'
    ];

    public function booking_services()
    {
        return $this->hasMany(BookingService::class);  
    }
}
