<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_comments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_comments';

    public function user()
    {
    	return $this->belongsTo('App\users');
    }

    public function work()
    {
    	return $this->belongsTo('App\works');
    }
}
