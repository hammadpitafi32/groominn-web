<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusinessImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_business_id','name'
    ];
}
