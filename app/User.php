<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Returns the list of issues that this user has posted
    public function issues()
    {
        return $this->hasMany('App\Issue');
    }


    // Returns the list of issues that this user has posted
    public function arguments()
    {
        return $this->hasMany('App\Argument');
    }
}
