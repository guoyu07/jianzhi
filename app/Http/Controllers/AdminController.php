<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests;
use App\admins;
use App\users;
use App\employers;
use App\works;
use Validator;
use Auth;

class AdminController extends Controller
{
    use ThrottlesLogins;
    public function __construct()
    {
    	$this->middleware('auth:admins',['except' => [
            'getLogin',
            'postLogin',
        ]]);
    }

    public function getLogin()
    {
    	return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $messages = [
            'required'  => '这里不能为空',
        ];
        $validator = Validator::make($request->all(), [
            'account'     => 'required',
            'password'   => 'required',
        ],$messages);
        if ($validator->fails()) {
           return redirect()->back()->withErrors($validator)->withInput();
        }

        $account = $request->account;
        $password = $request->password;
        if (Auth::guard('admins')->attempt(['account' => $account, 'password' => $password])) {
            // Authentication passed...
            return redirect('/admin/index');
        }else{
            return redirect()->back()->withErrors(['pwError'=> '你所输入的密码不正确']);
        }

    }

    public function getIndex()
    {
        $works = works::all();
        $users = users::all();
        $employers = employers::all();
    	return view('admin.index',['works'=>$works,'users'=>$users,'employers'=>$employers]);
    }

    public function getWorksCheck()
    {
        $works = works::where('checked',0)->get();
        return view('admin.worksCheck',['works'=>$works]);
    }

    public function postWorksCheck(Request $request)
    {
        $work_id = $request->work_id;
        $work = works::findOrFail($work_id);
        $work->checked = $request->status;
        if($request->status){
            $work->applyable=1;
            $work->save();
            return response()->json(['message' => '您已审核并通过了他的兼职。']);
        }else{
            $work->finished = 1;
             $work->save();
            return response()->json(['message' => '您已拒绝了他的兼职审核。']);
        }
    }

    public function getWorks()
    {
        $works = works::all();
        return view('admin.works',['works'=>$works]);
    }

    public function getUsers()
    {
        $users = users::all();
        return view('admin.users',['users'=>$users]);
    }

    public function getEmployers()
    {
        $employers = employers::all();
        return view('admin.employers',['employers'=>$employers]);
    }
}
