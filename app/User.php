<?php
/**
* User class file. Contains the User class which is an Eloquent model for the users relation.
*/

namespace CmcEssentials;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
* This is an Elloquent model class for the users database relation.
* The User class provides the following fillable properties of the model.
* name              : A username for the user.
* email             : Unique email for the user. 
* password          : Password hash of the user.
*/
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
}
