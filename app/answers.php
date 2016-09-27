<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class answers extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'answers';

    public  function question()
    {
    	return $this->belongsTo('App\questions');
    }

    public function employer()
    {
    	return $this->belongsTo('App\employers');
    }
}
