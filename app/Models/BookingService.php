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
        'booking_id','user_business_category_service_id','category_name','service_name','duration','charges','date','type'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function category_services()
    {
        return $this->hasOne('App\Models\UserBusinessCategoryService', 'id', 'user_business_category_service_id');

        // return $this->belongsTo(UserBusinessCategoryService::class,'id','user_business_category_service_id');

    }
}
