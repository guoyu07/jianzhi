<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use DB;
use App\works;

class users extends Model implements AuthenticatableContract,AuthorizableContract
{
    use Authenticatable,Authorizable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $guarded = ['password'];

    public function questions()
    {
    	return $this->hasMany('App\questions','user_id');
    }

    public function works()
    {
        return $this->belongsToMany('App\works','apply_jobs','user_id','work_id')->withPivot('apply_status','pass_status','finished_status')->orderBy('created_at','desc')->get(); 
    }

    public function works_applying()
    {
        return $this->belongsToMany('App\works','apply_jobs','user_id','work_id')
            ->wherePivot('apply_status', 1)->orderBy('created_at','desc')->get();
    }

    public function works_passed()
    {
        return $this->belongsToMany('App\works','apply_jobs','user_id','work_id')
            ->wherePivot('pass_status', 1)->wherePivot('finished_status', 0)->orderBy('created_at','desc')->get();
    }

    public function works_rejected()
    {
    	return $this->belongsToMany('App\works','apply_jobs','user_id','work_id')
            ->wherePivot('reject_status', 1)->wherePivot('finished_status', 0)->orderBy('created_at','desc')->get();
        
    }

    public function works_finished()
    {
        return $this->belongsToMany('App\works','apply_jobs','user_id','work_id')
            ->wherePivot('finished_status', 1)->orderBy('created_at','desc')->get();
    }

    public function works_passed_finished()
    {
        return $this->belongsToMany('App\works','apply_jobs','user_id','work_id')
            ->wherePivot('finished_status', 1)->wherePivot('pass_status', 1)->orderBy('created_at','desc')->get();
    }


    public function comments()
    {
    	return $this->hasMany('App\employer_comments','user_id');
    }

    public function commentOnWork($work_id)
    {
        return $this->hasMany('App\employer_comments','user_id')->where('work_id',$work_id)->first();
    }

    public function friends()
    {
    	return $this->belongsToMany('App\users','App\user_friends','user1_id','user2_id');
    }

    public function follow()
    {
    	return $this->belongsToMany('App\employers','App\employer_fans','user_id','employer_id');
    }

    public function employer_friends()
    {
    	return $this->belongsToMany('App\employers','App\employer_friends','user_id','employer_id');
    }
}
