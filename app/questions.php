<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    public function work()
    {
    	return $this->belongsTo('App\works');
    }

    public function user()
    {
        return $this->belongsTo('App\users');
    }

    public function answers()
    {
        return $this->hasMany('App\answers','question_id');
    }
}
