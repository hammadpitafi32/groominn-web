<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusinessSchedule extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_business_id','day','open_at','close_at'
    ];
}
