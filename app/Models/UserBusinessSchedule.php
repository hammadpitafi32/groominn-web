<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBusinessSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_business_id','day','open_at','close_at'
    ];
}
