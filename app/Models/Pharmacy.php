<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'priority',
        'owner_user_id',
        'area_id',
        'name',
        'deleted_at',
    ];


    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_user_id', "id");
    }

    public function type()
    {
        return $this->morphOne(User::class, 'typeable');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, "pharmacy_id");
    }


    public function orders()
    {
        return $this->hasMany(Order::class, 'pharmacy_id');
    }
}
