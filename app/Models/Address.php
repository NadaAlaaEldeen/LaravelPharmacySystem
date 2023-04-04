<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'building_number',
        'street_name',
        'floor_number',
        'flat_number',
        'is_main',
        'area_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}
