<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','phone','gender','date_of_birth','address_line_1','address_line_2','country_id','state_id','city','zip_code','tax_id'
    ];
}
