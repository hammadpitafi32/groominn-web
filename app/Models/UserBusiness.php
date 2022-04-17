<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Casts\Attribute;
class UserBusiness extends Model
{
    use HasFactory;

    /*accessors*/
    public function getCnicFrontPathAttribute()       
    {        
        return  asset($this->cnic_front);       
    }
    /*end*/

    public function user_business_schedules()
    {
        // return $this->hasMany('App\Models\UserBusinessSchedule','user_business_id', 'id');
        return $this->hasMany(UserBusinessSchedule::class);
        
    }

    public function user_business_images()
    {
        return $this->hasMany(UserBusinessImage::class);  
    }

    public function user_business_category_services()
    {
        return $this->hasMany(UserBusinessCategoryService::class);  
    }
}
