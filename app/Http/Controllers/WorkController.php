<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\apply_jobs;
use App\employers;
use Auth;
use App\works;

class WorkController extends Controller
{
    
    public function getWork($id)
    {
    	$work = works::findOrFail($id);
    	$work->page_view++;
    	$work->save();
    	return view('/work/info',['work'=>$work]);
    }

    public function postWork(Request $request,$id)
    {
    	try{
    	$apply_job = new apply_jobs;
    	$apply_job->work_id = $request->work_id;
    	$apply_job->user_id = $request->user_id;
        $apply_job->apply_status = 1;
    	$apply_job->save();
    	return response()->json(['message' => '你已经成功申请兼职了，请耐心等候商家的回复。']);
    	}catch(\Exception $error){
    		return response()->json(['message'=>$error]);
    	}
    }

    public function postApplyDecide(Request $request)
    {
        $work_id = $request->work_id;
        $user_id = $request->user_id;
        $work    = works::findOrFail($work_id);
        $apply_job = apply_jobs::where([['user_id',$user_id],['work_id',$work_id]]);
        if($request->status)
        {
            $apply_job->update(['pass_status' => 1]);
            $apply_job->update(['apply_status' => 0]);
            $work->hired_num++;
            $work->save();
            return response()->json(['message' =>'您已经同意了他的申请']);
        }else{
            
            $apply_job->update(['apply_status' => 0]);
            $apply_job->update(['reject_status' => 1]);
            return response()->json(['message' =>'您已经拒绝了他的申请']);
        }
    }

    public function postApplyEnd(Request $request)
    {
        $work_id = $request->work_id;
        $work    = works::findOrFail($work_id);
        $work->applyable = 0;
        $work->finished  = 1;
        $work->save();
        $employer = employers::findOrFail(Auth::guard('employers')->user()->id);
        $employer->exp = $employer->exp + $work->pay;
        $employer->save();
        foreach ($work->users() as  $user) {
            $user->exp = $user->exp + $work->pay;
            $user->save();
        }
        $apply_job = apply_jobs::where('work_id',$work_id)->update(['finished_status' => 1]);
        return response()->json(['message' =>'您已经结束了该兼职的申请']);
    }
}
