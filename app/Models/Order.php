<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'is_insured',
        'user_id',
        'pharmacy_id',
        'address_id',
    ];

    public function order_image()
    {
        return $this->hasMany(OrderImage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function medicine()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('quantity');
    }
}
