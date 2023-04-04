<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'is_insured',
        'total_price',
        'created_at',
        'updated_at',
        'pharmacy_id',
        'address_id',
        'user_id',
        'prescription',
        'cancellation_reason'
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
        
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
           'created_at' => 'datetime',
           'updated_at' => 'datetime',
    ];

    public function order_image() { 
        return $this->hasMany(OrderImage::class);
       } 
    public function user() { 
        // return $this->hasMany(User::class);
        return $this->belongsTo(User::class);

       } 
    public function pharmacy() { 
        // return $this->hasMany(Pharmacy::class);
        return $this->belongsTo(Pharmacy::class);
       } 
    public function address() { 
        // return $this->hasMany(Address::class);
        return $this->belongsTo(Address::class);
       } 
}
