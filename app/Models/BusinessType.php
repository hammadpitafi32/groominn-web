<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory;

    protected $fillable=['name','image','bgColor'];

    public function businesses()
    {
        return $this->hasMany(UserBusiness::class,'business_type_id','id');  
    }

}
