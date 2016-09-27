<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \PhpSms;

class TestController extends Controller
{
    public function _construct()
    {
    	$this->middleware('auth');
    }

    public function getTest()
    {
    	return 'haha';
    }

    public function postQuestion(Requests $request,$work_id)
    {
    	$question = new questions;
    	$question->content = $request->content;
    	$question->work_id = $work_id;
    	$question->user_id = $request->user->id;
    	$question->save();
    	dd($question);

    }
}
