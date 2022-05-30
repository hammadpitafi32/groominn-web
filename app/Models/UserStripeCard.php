<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStripeCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_stripe_info_id','card_id','last_four_digit','card_type'
    ];
}
