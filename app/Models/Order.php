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
        'total_price',
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
    public function totalPrice()
    {
        $total = 0;
        foreach ($this->medicines as $med) {
            $total += $med->price * $med->pivot->quantity;
        }

        return $total;
    }
}
