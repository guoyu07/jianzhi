<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\works;
use App\Http\Requests;
use App\employer_comments;
use App\user_comments;
use Auth;
use Validator;

class CommentController extends Controller
{
	
    public function getEmployerCommentForm($work_id)
    {
    	$work = works::findOrFail($work_id);
    	$users= $work->users_passed();
    	return view('employer/comments',['users'=>$users,'work'=>$work]);
    }

    public function postEmployerCommentForm(Request $request,$work_id,$user_id)
    {
    	$messages = [
    		'required'  => '这里不能为空',
		];
		$validator = Validator::make($request->all(), [
	        'content'     => 'required',
   		],$messages);
   		if ($validator->fails()) {
	       return redirect()->back()->withErrors($validator)->withInput();
   		}
    	$comment = new employer_comments;
    	$comment->work_id = $work_id;
    	$comment->user_id = $user_id;
    	$comment->employer_id =Auth::guard('employers')->user()->id;
    	$comment->ability_stars = $request->ability_stars;
    	$comment->attitude_stars = $request->attitude_stars;
    	$comment->content = $request->content;
    	$comment->save();
        return redirect()->back();
    }

    public function getUserCommentForm($work_id)
    {
        $work = works::findOrFail($work_id);
        $employer= $work->employer();
        return view('user/comments',['employer'=>$employer,'work'=>$work]);
    }

    public function postUserCommentForm(Request $request,$work_id)
    {
        $messages = [
            'required'  => '这里不能为空',
        ];
        $validator = Validator::make($request->all(), [
            'content'     => 'required',
        ],$messages);
        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
        }
        $comment = new user_comments;
        $comment->work_id = $work_id;
        $comment->user_id = Auth::user()->id;
        $comment->pay_stars = $request->pay_stars;
        $comment->description_stars = $request->description_stars;
        $comment->payspeed_stars = $request->payspeed_stars;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back();
    }
}
