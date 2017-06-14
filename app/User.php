<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'user';
/*
    protected $table = 'user';*/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type',
        'name',
        'id',
        'pw',
        'age',
        'gender',
        'email',
        'telephone',
        'cellphone',
        'zip_code',
        'main_address',
        'rest_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pw',
        'remember_token',
    ];
}
