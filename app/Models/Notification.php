<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'type','data','read_at','title','from_user','to_user','seen','status'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user');
    }
    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user');
    }

    public function getCreatedAtAttribute($value) {
            
        return $date=\Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');

    }

}
