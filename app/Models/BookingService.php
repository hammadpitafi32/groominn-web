<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'booking_id','user_business_category_service_id','duration','charges','date','type'
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
