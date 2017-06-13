<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Target extends Authenticatable
{
    use Notifiable;
    protected $table = 'target';
/*
    protected $table = 'user';*/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'profile_image',
      'age',
      'gender',
      'telephone',
      'cellphone',
      'zip_code',
      'main_address',
      'rest_address',
      'latitude',
      'longitude',
      'disability_main',
      'disability_sub',
      'comment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = [
       'latitude',
       'longitude',
     ];
}
