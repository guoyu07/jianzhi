<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests;
use App\users;
use App\employers;
use App\works;
use Image;
use Validator;
use Auth;

class UserController extends Controller
{
	use ThrottlesLogins;

    

    public function getLogout()
    {
    	Auth::logout();
    	return redirect('/user/login');
    }

    public function postLogin(Request $request)
    { 
    	$messages = [
    		'required'  => '这里不能为空',
    		'zh_mobile' => '请输入正确的手机号码',
    		'exists' => '您还没注册，请先注册',
		];
		$validator = Validator::make($request->all(), [
	        'mobile'     => 'required|zh_mobile|exists:users',
	        'password'   => 'required',
   		],$messages);
   		if ($validator->fails()) {
	       return redirect()->back()->withErrors($validator)->withInput();
   		}

   		$mobile = $request->mobile;
   		$password = $request->password;
   		if (Auth::attempt(['mobile' => $mobile, 'password' => $password])) {
            // Authentication passed...
            return redirect('/user/work');
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
	      'mobile'     => 'required|unique:users|confirm_mobile_not_change',
	      'verifyCode' => 'required|verify_code|confirm_mobile_rule:mobile_required',
	      'password'   => 'required|confirmed',
	      'password_confirmation' => 'required',
        
   		],$messages);
   		if ($validator->fails()) {
       //验证失败后建议清空存储的短信发送信息，防止用户重复试错
	       \SmsManager::forgetSentInfo();
	       return redirect()->back()->withErrors($validator)->withInput();
   		}

   		$user= new users;
   		$user->name = $request->name;
   		$user->mobile = $request->mobile;
   		$user->password = bcrypt($request->password);
   		$user->save();
   		Auth::login($user);
   		return redirect('/user/work');

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
	        'mobile'     => 'required|zh_mobile|exists:users',
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
   		$user = App/users::find('mobile','$mobile');
   		$user->password = $password;
   		$user->save();
   		return redirect('/user/login');
    }

    public function getWork()
    {
      $works=works::orderBy('created_at', 'desc')->where('checked','1')->where('finished','0')->where('applyable','1')->get();
      return view('user/work',['works'=>$works]);
    }

    public function getInfo($id)
    {
      $user = users::findOrFail($id);
      return view('user/info',['user'=>$user]);
    }

    public function getEmployerInfo($id)
    {
      $employer = employers::findOrFail($id);
      return view('user/employerInfo',['employer'=>$employer]);
    }

    public function getInfoEdit($id)
    {
      $user = users::findOrFail($id);
      return view('user/infoEdit',['user'=>$user]);
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

      $id = Auth::user()->id;
      $user = users::findOrFail($id);
      $image = $request->pic_path;
      if(!empty($image)){
      $clientName = $image -> getClientOriginalName();
        if(!empty($user->pic_path) and $user->pic_path!= 'default.png'){
          $old_pic = public_path().'\image\users\\'.$user->pic_path;
          unlink($old_pic);}
        $newName = $id.md5(date('ymdhm')).$clientName;
        $user->pic_path = $newName;
        $new_pic = public_path().'\image\users\\'.$newName;
        $result=$image->move('image\users',$newName);
        Image::make($new_pic)->resize(100, 100)->save();}
      $user->age = $request->age;
      $user->gender = $request->gender;
      $user->city = $request->city;
      $user->school = $request->school;
      $user->major = $request->major;
      $user->introduction = $request->introduction;
      $user->save();
      return view('user/info',['user'=>$user]);
    }

    public function getMyWork()
    {
      $works = Auth::user()->works();
      return view('user/mywork',['works'=>$works]);
    }
}