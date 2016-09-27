<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employer_comments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employer_comments';

    public function employer()
    {
    	return $this->belongsTo('App\employers');
    }

    public function work()
    {
    	return $this->belongsTo('App\works');
    }
}
