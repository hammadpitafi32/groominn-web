<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'user_id','name',
    ];
    

    public function user_business_category_services()
    {
        return $this->hasMany(UserBusinessCategoryService::class);  
    }

    


    /**
    * Override parent boot and Call deleting event
    *
    * @return void
    */
    protected static function boot() 
    {

        parent::boot();

        static::deleting(function($model) {
           foreach ($model->user_business_category_services()->get() as $data) {
                $data->delete();
            }
        });

        /*restoring*/
        static::restoring(function($model) {
            foreach ($model->user_business_category_services()->withTrashed()->get() as $data) {
                $data->restore();
            }
        });
    }
}
