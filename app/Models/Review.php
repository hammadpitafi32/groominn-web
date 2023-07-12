<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'rating','detail','user_business_category_service_id','booking_id','user_business_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d h:m:i');
    }
}
