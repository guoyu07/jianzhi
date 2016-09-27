<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class admins extends Model implements  AuthenticatableContract, AuthorizableContract
{
    use Authenticatable,  Authorizable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';
}