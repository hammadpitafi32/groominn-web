<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBusinessCategoryService extends Model
{
    use HasFactory;

    public function user_category()
    {
        return $this->belongsTo(UserCategory::class);
    }

    public function user_service()
    {
        return $this->belongsTo(UserService::class);
    }

}
