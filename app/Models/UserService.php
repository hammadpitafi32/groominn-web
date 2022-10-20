<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserService extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user_business_category_services()
    {
        return $this->hasMany(UserBusinessCategoryService::class);  
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id', 'id');
    }
}
