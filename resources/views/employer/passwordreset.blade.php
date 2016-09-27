@extends('layout.empmain')

@section('content')
<div class="container">
    <div class="row" style="padding-top:100px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3>修改密码</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/employer/passwordreset') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">手机号码</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('verifyCode') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">验证码</label>

                            <div class="col-md-3">
                            <input type="text" class="form-control" name="verifyCode">
                            </div>
                            <div class="col-md-3">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-raised" id="sendVerifySmsButton" type="button">发送验证码</button>
                            </span>
                                @if ($errors->has('verifyCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verifyCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">再次输入密码</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-success btn-raised">
                                    修改密码
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     $('#sendVerifySmsButton').sms({
        //laravel csrf token value
        //PS:该token仅为laravel框架的csrf验证，不是无会话json api所用的token
        token          :"{{csrf_token()}}",

        //json api token
        //PS:如果你使用的是无会话json api，可以这样带上token
        apiToken       : 'user token string...',

        //定义如何获取mobile的值
        mobileSelector : 'input[name="mobile"]',

        //定义手机号的检测规则,当然你还可以到配置文件中自定义你想要的任何规则
        mobileRule     : 'mobile_required',

        //是否请求语音验证码
        voice          : false,

        //定义服务器有消息返回时如何展示，默认为alert
        alertMsg       :  function (msg, type) {
            alert(msg);
        },
     });
  </script>
@endsection
