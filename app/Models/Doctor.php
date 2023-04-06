<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'is_ban',
        'created_at',
        'user_id',
        'pharmacy_id'
    ];

    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, "pharmacy_id");
    }

    public function user()
    {
        return $this->belongsTo( User::class, "user_id");
    }

    public function order(){
        return $this->hasMany(Order::class,'doctor_id');
    }

}
