<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Cashier\Billable;
use App\Notifications\greetingNotification;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'national_id',
        'gender',
        'birth_day',
        'mobile',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, "id");
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, "id");
    }

    public function areas()
    {
        return $this->hasOne(Doctor::class, "id");
    }


    public function orders()
{
    return $this->hasMany(Order::class);
}

    public function client()
    {
        return $this->hasOne(Client::class, "id");

    }

    public function pharmacy()
    {
        return $this->hasOne(Pharmacy::class, 'owner_user_id', "id");
    }

    public function typeable()
    {
        return $this->morphTo();
    }

}
