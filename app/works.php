<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class works extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'works';

    public function employer()
    {
    	return $this->belongsTo('App\employers')->first();
    }

    public function questions()
    {
    	return $this->hasMany('App\questions','work_id');
    }

    public function answers()
    {
    	return $this->hasMany('App\answers');
    }

    public function users()
    {
    	return $this->belongsToMany('App\users','apply_jobs','work_id','user_id')->orderBy('created_at','desc')->get();
    }

    public function users_unchecked()
    {
        return $this->belongsToMany('App\users','apply_jobs','work_id','user_id')->wherePivot('apply_status',1)->orderBy('created_at','desc')->get();
    }

    public function users_passed()
    {
        return $this->belongsToMany('App\users','apply_jobs','work_id','user_id')->wherePivot('pass_status',1)->orderBy('created_at','desc')->get();
    }

    public function users_rejected()
    {
        return $this->belongsToMany('App\users','apply_jobs','work_id','user_id')->wherePivot('reject_status',1)->orderBy('created_at','desc')->get();
    }

    public function comments()
    {
        return $this->hasMany('App\user_comments','work_id');
    }

    public function commentOnUser($user_id)
    {
        return $this->hasMany('App\user_comments','work_id')->where('user_id',$user_id)->first();
    }
}
