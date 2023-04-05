<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'name',
        'address',
    ];

    public function addresses() {
        return $this->hasMany(Address::class, 'area_id');
       }

       public function pharmacies()
       {
           return $this->hasMany(Pharmacy::class,'id');
       }
}
