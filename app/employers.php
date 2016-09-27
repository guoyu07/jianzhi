<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class employers extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable,  Authorizable;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employers';
    protected $guarded = ['password'];

    public function company()
    {
    	return $this->hasOne('App\companys','company_id');
    }

    public function works()
    {
    	return $this->hasMany('App\works','employer_id');
    }

    public function answers()
    {
    	return $this->hasMany('App\answers','employer_id');
    }

    public function comments()
    {
    	return $this->hasMany('App\user_comments','employer_id');
    }

    public function commentOnWorkAndUser($work_id,$user_id)
    {
        return $this->hasMany('App\employer_comments','employer_id')->where([['user_id',$user_id],['work_id',$work_id]])->first();
    }

    public function fans()
    {
    	return $this->hasManyThrough('App\users','App\employer_fans','employer_id','user_id');
    }
    public function friends()
    {
    	return $this->hasManyThrough('App\users','App\employer_friends','employer_id','user_id');
    }
}
