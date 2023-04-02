<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'is_insured',
        'user_id',
        'pharmacy_id',
        'address_id',	
    ];

    public function order_image() { 
        return $this->hasMany(OrderImage::class);
       } 
    public function user() { 
        return $this->hasMany(User::class);
       } 
    public function pharmacy() { 
        return $this->hasMany(Pharmacy::class);
       } 
    public function address() { 
        return $this->hasMany(Address::class);
       } 
}