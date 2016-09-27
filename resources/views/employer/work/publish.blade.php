@extends('layout.empmain')

@section('content')
<div class="container">
    <div class="row" style="padding:100px,0px,100pc;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3>发布兼职</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/employer/work/publish') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">标题</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">工作类型</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control" name="type">
                                  <option @if(old('type')==='礼仪模特') selected = "selected" @endif>礼仪模特</option>
                                  <option @if(old('type')==='老师家教') selected = "selected" @endif>老师家教</option>
                                  <option @if(old('type')==='促销导购') selected = "selected" @endif>促销导购</option>
                                  <option @if(old('type')==='话务客服') selected = "selected" @endif>话务客服</option>
                                  <option @if(old('type')==='传单派发') selected = "selected" @endif>传单派发</option>
                                  <option @if(old('type')==='审核录入') selected = "selected" @endif>审核录入</option>
                                  <option @if(old('type')==='服务员') selected = "selected" @endif>服务员</option>
                                  <option @if(old('type')==='问卷调查') selected = "selected" @endif>问卷调查</option>
                                  <option @if(old('type')==='地推拉访') selected = "selected" @endif>地推拉访</option>
                                  <option @if(old('type')==='其他') selected = "selected" @endif>其他</option>         
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-group{{ $errors->has('work_time') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">工作时间</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="work_time" value="{{ old('work_time') }}">

                                @if ($errors->has('work_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('work_time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">工作地址</label>

                            <div class="col-md-3">

                                <select id="city" class="form-control" name="city">
                                  <option>深圳</option>         
                                </select>


                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                 <select id="type" class="form-control" name="district">
                                  <option @if(old('district')==='福田区') selected = "selected" @endif>福田区</option>
                                  <option @if(old('district')==='罗湖区') selected = "selected" @endif>罗湖区</option>
                                  <option @if(old('district')==='南山区') selected = "selected" @endif>南山区</option>
                                  <option @if(old('district')==='宝安区') selected = "selected" @endif>宝安区</option>
                                  <option @if(old('district')==='龙岗区') selected = "selected" @endif>龙岗区</option>
                                  <option @if(old('district')==='盐田区') selected = "selected" @endif>盐田区</option>
                                  <option @if(old('district')==='光明新区') selected = "selected" @endif>光明新区</option>
                                  <option @if(old('district')==='大鹏新区') selected = "selected" @endif>大鹏新区</option>
                                  <option @if(old('district')==='坪山新区') selected = "selected" @endif>坪山新区</option>
                                  <option @if(old('district')==='龙华新区') selected = "selected" @endif>龙华新区</option>        
                                </select>
                            </div>
                            <div class="col-md-6 col-md-offset-4"><input type="text" class="form-control" name="address" placeholder="请输入具体地址" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('need_num') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">需要人数</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="need_num" value="{{ old('need_num') }}">

                                @if ($errors->has('need_num'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('need_num') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pay') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">工资</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="pay" value="{{ old('pay') }}">

                                @if ($errors->has('pay'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pay') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('commission') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">提成</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="commission" value="{{ old('commission') }}">

                                @if ($errors->has('commission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">工资发放方式</label>
                            <div class="col-md-6">
                            <select id="pay_type" class="form-control" name="pay_type" >
                                  <option @if(old('pay_type')==='现金结账') selected = "selected" @endif>现金结账</option>
                                  <option @if(old('pay_type')==='支付宝转账') selected = "selected" @endif>支付宝转账</option>
                                  <option @if(old('pay_type')==='微信支付') selected = "selected" @endif>微信支付</option>
                                  <option @if(old('pay_type')==='银行卡转账') selected = "selected" @endif>银行卡转账</option>
                                  <option @if(old('pay_type')==='其他') selected = "selected" @endif>其他</option>       
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">工资发放时间</label>
                            <div class="col-md-6">
                            <select id="pay_time" class="form-control" name="pay_time">
                                  <option @if(old('pay_time')==='现结') selected = "selected" @endif>现结</option>
                                  <option @if(old('pay_time')==='周结') selected = "selected" @endif>周结</option>
                                  <option @if(old('pay_time')==='月结') selected = "selected" @endif>月结</option>
                                  <option @if(old('pay_time')==='其他') selected = "selected" @endif>其他</option>       
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">工作餐</label>
                            <div class="col-md-6">
                            <div class="radio radio-primary radio-inline">
                                  <label>
                                    <input type="radio" name="lunch" id="lunchRadios1" value="包餐" @if(old('lunch')==='包餐' ) checked="checked" @endif>
                                    包餐
                                  </label>
                                </div>
                                <div class="radio radio-primary radio-inline">
                                  <label>
                                    <input type="radio" name="lunch" id="lunchRadios2" value="不包餐" @if(old('lunch')==='不包餐' ) checked="checked" @endif>
                                    不包餐
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">性别</label>
                            <div class="col-md-6">
                            <div class="radio radio-primary radio-inline">
                                  <label>
                                    <input type="radio" name="gender" id="genderRadios1" value="男" @if(old('gender')==='男' ) checked="checked" @endif>
                                    男
                                  </label>
                                </div>
                                <div class="radio radio-primary radio-inline">
                                  <label>
                                    <input type="radio" name="gender" id="genderRadios2" value="女" @if(old('gender')==='女' ) checked="checked" @endif>
                                    女
                                  </label>
                                </div>
                                <div class="radio radio-primary radio-inline">
                                  <label>
                                    <input type="radio" name="gender" id="genderRadios3" value="不限" @if(old('gender')==='不限' ) checked="checked" @endif>
                                    不限
                                  </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">联系方式</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="contact" value="{{ old('contact') }}">

                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('interview_time') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">面试时间</label>
                            <div class="col-md-6">
                                <div class="input-append date form_datetime">
                                    <input class="form-control" name="interview_time" size="16" type="text" value="" readonly value="{{ old('interview_time') }}">
                                    <span class="add-on"><i class="icon-th"></i></span>

                                @if ($errors->has('interview_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('interview_time') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('interview_place') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">面试地点</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="interview_place" value="{{ old('interview_place') }}">

                                @if ($errors->has('interview_place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('interview_place') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('interviewer') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">面试官</label>
                            <div class="col-md-6"><input type="text" class="form-control" name="interviewer" value="{{ old('interviewer') }}">

                                @if ($errors->has('interviewer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('interviewer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('requirements') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">工作要求</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" id="requirements" name="requirements">{{ old('requirements') }}</textarea>

                                @if ($errors->has('requirements'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('requirements') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">工作内容</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="3" id="description" name="description">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-success btn-raised">
                                    发布兼职
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy年mm月dd日hh:ii"
    });
</script> 
@endsection


