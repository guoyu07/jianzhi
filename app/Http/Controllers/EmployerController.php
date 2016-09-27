<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\employers;
use Image;
use App\users;
use App\answers;
use App\works;
use Validator;
use Auth;

class EmployerController extends Controller
{
	use ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('auth:employers',['except' => [
            'getLogout',
            'postLogin',
            'postRegister',
            'postPasswordReset',
            'getInfo'
        ]]);
    }

    public function getLogout()
    {
    	Auth::guard('employers')->logout();
    	return redirect('/employer/login');
    }


    public function postLogin(Request $request)
    {
    	$messages = [
    		'required'  => '这里不能为空',
    		'zh_mobile' => '请输入正确的手机号码',
    		'exists' => '您还没注册，请先注册',
		];
		$validator = Validator::make($request->all(), [
	        'mobile'     => 'required|zh_mobile|exists:employers',
	        'password'   => 'required',
   		],$messages);
   		if ($validator->fails()) {
	       return redirect()->back()->withErrors($validator)->withInput();
   		}

   		$mobile = $request->mobile;
   		$password = $request->password;
   		if (Auth::guard('employers')->attempt(['mobile' => $mobile, 'password' => $password])) {
            // Authentication passed...
            return redirect('/employer/work');
        }else{
        	return redirect()->back()->withErrors(['pwError'=> '你所输入的密码不正确']);
        }
    }

    public function postRegister(Request $request)
    {
    	$messages = [
    		'required' => '这里不能为空',
    		'confirmed'=> '前后输入的密码不一样',
    		'confirm_mobile_not_change' => '接收验证码的手机号码跟注册的号码不一样',
    		'confirm_mobile_rule' => '请输入正确的手机号码',
    		'min'    => '姓名不能少于2个字',
    		'unique'   => '您的手机号码已注册，请登录',
    		'verify_code' => '验证码不正确，请重输',
		];
    	$validator = Validator::make($request->all(), [
	    	'name'       => 'required|min:2',
	        'mobile'     => 'required|unique:employers|confirm_mobile_not_change',
	        'verifyCode' => 'required|verify_code|confirm_mobile_rule:mobile_required',
	        'password'   => 'required|confirmed',
	        'password_confirmation' => 'required',
        
   		],$messages);
   		if ($validator->fails()) {
       //验证失败后建议清空存储的短信发送信息，防止用户重复试错
	       \SmsManager::forgetSentInfo();
	       return redirect()->back()->withErrors($validator)->withInput();
   		}

   		$employer= new employers;
   		$employer->name = $request->name;
   		$employer->mobile = $request->mobile;
   		$employer->password = bcrypt($request->password);
   		$employer->save();
   		Auth::guard('employers')->login($employer);
   		return redirect('/employer/work');

    }

    public function postPasswordReset(Request $request)
    {
    	$messages = [
    		'required' => '这里不能为空',
    		'confirmed'=> '前后输入的密码不一样',
    		'zh_mobile' => '请输入正确的手机号码',
    		'exists' => '您还没注册，请先注册',
    		'verify_code' => '验证码不正确，请重输',
		];
    	$validator = Validator::make($request->all(), [
	    	'name'       => 'required|min:2',
	        'mobile'     => 'required|zh_mobile|exists:employers',
	        'verifyCode' => 'required|verify_code|confirm_mobile_rule:mobile_required',
	        'password'   => 'required|confirmed',
	        'password_confirmation' => 'required',
        
   		],$messages);
   		if ($validator->fails()) {
       //验证失败后建议清空存储的短信发送信息，防止用户重复试错
	       \SmsManager::forgetSentInfo();
	       return redirect()->back()->withErrors($validator)->withInput();
   		}

   		$mobile = $request->mobile;
   		$password = bcrypt($request->password);
   		$employer = App\employers::find('mobile','$mobile');
   		$employer->password = $password;
   		$employer->save();
   		return redirect('/employer/login');
    }

    public function postPublish(Request $request)
    {
      $messages = [
        'required' => '这里不能为空',
        'numeric'  => '请输入数字',
    ];
      $validator = Validator::make($request->all(), [
        'title'       => 'required|min:2',
        'work_time'     => 'required',
        'address'     => 'required',
        'need_num' => 'required|numeric',
        'contact'   => 'required',
        'pay' => 'required|numeric',
        'interview_time' => 'required',
        'interview_place' => 'required',
        'interviewer' => 'required',
        'requirements' => 'required',
        'description' => 'required',
      ],$messages);
      if ($validator->fails()) {
       
         return redirect()->back()->withErrors($validator)->withInput();
      }

      $work = new works;
      $work->title = $request->title;
      $work->type  = $request->type;
      $work->work_time = $request->work_time;
      $work->city  = $request->city;
      $work->district  = $request->district;
      $work->address   = $request->address;
      $work->need_num  = $request->need_num;
      $work->pay_type  = $request->pay_type;
      $work->pay_time  = $request->pay_time;
      $work->pay   = $request->pay;
      $work->commission= $request->commission;
      $work->lunch = $request->lunch;
      $work->gender= $request->gender;
      $work->contact   = $request->contact;
      $work->interview_time = $request->interview_time;
      $work->interview_place= $request->interview_place;
      $work->interviewer = $request->interviewer;
      $work->requirements= $request->requirements;
      $work->description = $request->description;
      $work->employer_id = Auth::guard('employers')->user()->id;
      $work->save();
      return redirect('/employer/work');
    }

    public function getWorkInfo($id)
    {
      $work = works::findOrFail($id);
      return view('employer/work/info',['work'=>$work]);
    }

    public function getWork()
    {
      $works = Auth::guard('employers')->user()->works()->orderBy('created_at', 'desc')->get();
      return view('employer/work/mywork',['works' => $works]);
    }

    public function postAnswer(Request $request,$question_id)
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
      $answer = new answers;
      $answer->content = $request->content;
      $answer->question_id = $question_id;
      $answer->employer_id = Auth::guard('employers')->user()->id;
      $answer->save();
      return redirect()->back();
    }

    public function getInfo($id)
    {
      $employer = employers::findOrFail($id);
      return view('employer/info',['employer'=>$employer]);
    }

    public function getInfoEdit($id)
    {
      $employer = employers::findOrFail($id);
      return view('employer/infoEdit',['employer'=>$employer]);
    }

    public function postInfoEdit(Request $request)
    {
      $messages = [
        'image' => '头像的格式只能是jpeg, png, bmp, gif或者svg',
        'numeric' => '年龄只能为数字',
    ];
    $validator = Validator::make($request->all(), [
          'age'     => 'numeric',
          'pic_path'   => 'image',
      ],$messages);
      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator)->withInput();
      }

      $id = Auth::guard('employers')->user()->id;
      $employer = employers::findOrFail($id);
      $image = $request->pic_path;
      if(!empty($image)){
        $clientName = $image -> getClientOriginalName();
        if(!is_null($employer->pic_path)  and $employer->pic_path!= 'default.png'){
          $old_pic = public_path().'\image\employers\\'.$employer->pic_path;
          unlink($old_pic);}
        $newName = $id.md5(date('ymdhm')).$clientName;
        $employer->pic_path = $newName;
        $new_pic = public_path().'\image\employers\\'.$newName;
        $result=$image->move('image\employers',$newName);
        Image::make($new_pic)->resize(100, 100)->save();}
      $employer->age = $request->age;
      $employer->gender = $request->gender;
      $employer->city = $request->city;
      $employer->introduction = $request->introduction;
      $employer->save();
      return view('employer/info',['employer'=>$employer]);
    }

    public function getUserInfo($id)
    {
      $user = users::findOrFail($id);
      return view('employer/userInfo',['user'=>$user]);
    }

}