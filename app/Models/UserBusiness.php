<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Casts\Attribute;
class UserBusiness extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =['is_open','business_type_id'];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_business_images()
    {
        return $this->hasMany(UserBusinessImage::class);  
    }

    public function user_business_category_services()
    {
        return $this->hasMany(UserBusinessCategoryService::class);  
    }


    public function user_categories()
    {
        return $this->hasMany('App\Models\UserCategory','user_id', 'user_id'); 
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class,'user_business_id','id');
    }

    /**
   * Override parent boot and Call deleting event
   *
   * @return void
   */
   protected static function boot() 
    {
      parent::boot();

      static::deleting(function($user_business) {
         foreach ($user_business->user_business_images()->get() as $post) {
            $post->delete();
         }

         foreach ($user_business->user_business_category_services()->get() as $post) {
            $post->delete();
         }
      });

      /*restoring*/
      static::restoring(function($user_business) {
        foreach ($user_business->user_business_images()->withTrashed()->get() as $post) {
            $post->restore();
        }

        foreach ($user_business->user_business_category_services()->withTrashed()->get() as $post) {
            $post->restore();
        }
      });
    }
}
