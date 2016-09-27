<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\questions as Question;
use Validator;

class QuestionController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function postQuestion(Request $request,$work_id)
    {
    	$messages = [
    		'required'  => '问题不能为空',
		];
		$validator = Validator::make($request->all(), [
	        'content'    => 'required',
   		],$messages);
   		if ($validator->fails()) {
	       return redirect()->back()->withErrors($validator)->withInput();
   		}
    	$question = new Question;
    	$question->content = $request->content;
    	$question->work_id = $work_id;
    	$question->user_id = $request->user()->id;
    	$question->save();
    	return redirect()->back();

    }
}
