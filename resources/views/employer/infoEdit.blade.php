@extends('layout.empmain')

@section('content')
<div class="container">
    <div class="row" style="padding-top:100px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3>修改个人资料</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/employer/info/edit" enctype="multipart/form-data">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('pic_path') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">头像</label>

                            <div class="col-md-6">
                                <input type="file" id="pic_path" multiple="false" name="pic_path">
                                <div class="input-group">
                                <input type="text" readonly="" class="form-control" placeholder="请上传您的头像" name="pic_path">
                                  <span class="input-group-btn input-group-sm">
                                    <button type="button" class="btn btn-fab btn-fab-mini">
                                      <span class="glyphicon glyphicon-cloud-upload"></span>
                                    </button>
                                  </span>
                                </div>
                                @if ($errors->has('pic_path'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pic_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">性别</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="gender" value="{{$employer->gender}}">

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">年龄</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="age" value="{{$employer->age}}">

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">城市</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city"  value="{{$employer->city}}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">个人简介</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="introduction">
                                     {{$employer->introduction}}
                                </textarea>
                                @if ($errors->has('introduction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('introduction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary btn-raised">提交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

