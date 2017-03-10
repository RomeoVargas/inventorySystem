<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const AUTH_TYPE_CUSTOMER    = 1;
    const AUTH_TYPE_ADMIN       = 2;

    const MAX_LENGTH_EMAIL = 50;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'auth_type',
        'first_name', 'last_name', 'contact_number', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getCartItems()
    {
        return $this->hasMany(Cart::class, 'user_id')->getResults();
    }
}
