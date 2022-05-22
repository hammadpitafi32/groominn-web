<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function user_categories()
    {
        return $this->hasMany(UserCategory::class);  
    }
}
