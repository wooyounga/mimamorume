<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'userType', 'pw' , 'name ', 'age' , 'gender' , 'email', 'telephone' , 'cellphone' , 'adressCity', 'adressGu' , 'adressDong' , 'adressRest'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pw', 'remember_token',
    ];
}
