@extends('layout.empmain')

@section('content')

	<div class="panel panel-primary">
		<div class="panel-heading"><b>{{$work->title}}--申请人评价</b></div>
		<div class="panel-body">
			@foreach($users as $user)
				<div class="row">
				<div class="col-md-1">
					<a href="/employer/user/info/{{$user->id}}"><h5>{{$user->name}}</h5></a>
					<a href="/employer/user/info/{{$user->id}}"><img src="/image/users/{{$user->pic_path}}" style="width: 70px;height: 70px;" alt="{{$user->name}}" class="avatar"></a>
				</div>
				<div class="col-md-11">
					<div class="row" style="font-size: 18px;  text-align: center;">
						<div class="col-md-2"  style="margin-top: 15px;">
							<p><span class="glyphicon glyphicon-thumbs-up"></span>点赞:{{$user->up}}</p>
							<p><span class="glyphicon glyphicon-heart"></span>感谢:{{$user->fans}}</p>
							<p><span class="glyphicon glyphicon-list-alt"></span>经验:{{$user->exp}}</p>	
						</div>
						<div class="col-md-10">
							@if($user->commentOnWork($work->id))
								<div class="col-md-4 " style="margin-top: 15px;">
									<h4>工作能力：{{$user->commentOnWork($work->id)->ability_stars}}/5</h4>
									<h4>工作态度：{{$user->commentOnWork($work->id)->attitude_stars}}/5</h4>
								</div>
								<div class="col-md-4" style="margin-top: 15px;">
									<h4>总体评价：{{$user->commentOnWork($work->id)->content}}</h4>
								</div>
								<div class="col-md-4">
									<button type="submit"  class="btn btn-raised btn-danger" style="margin-top: 30px;color: red;" disabled="disabled">已评论</button>
								</div>
							@else
							<form action="/employer/comment/{{$work->id}}/{{$user->id}}" method="post">
								{!! csrf_field() !!}
								<div class="col-md-5">
									<label class="col-md-4 control-label pull-left"><b>评分：</b></label>
									<div class="form-group">
			                            <label class="col-md-4 control-label">工作能力</label>
			                            <div class="col-md-8">
			                            <select id="ability_stars" class="form-control" name="ability_stars">
			                                  <option @if(old('ability_stars')==='1') selected = "selected" @endif>1</option>
			                                  <option @if(old('ability_stars')==='2') selected = "selected" @endif>2</option>
			                                  <option @if(old('ability_stars')==='3') selected = "selected" @endif>3</option>
			                                  <option @if(old('ability_stars')==='4') selected = "selected" @endif>4</option> 
			                                  <option @if(old('ability_stars')==='5') selected = "selected" @endif>5</option>      
			                                </select>
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <label class="col-md-4 control-label">工作态度</label>
			                            <div class="col-md-8">
			                            <select id="attitude_stars" class="form-control" name="attitude_stars">
			                                  <option @if(old('attitude_stars')==='1') selected = "selected" @endif>1</option>
			                                  <option @if(old('attitude_stars')==='2') selected = "selected" @endif>2</option>
			                                  <option @if(old('attitude_stars')==='3') selected = "selected" @endif>3</option>
			                                  <option @if(old('attitude_stars')==='4') selected = "selected" @endif>4</option> 
			                                  <option @if(old('attitude_stars')==='5') selected = "selected" @endif>5</option>      
			                                </select>
			                            </div>
			                        </div>
		                        </div>
		                        <div class="col-md-5">
		                        	<label class="col-md-4 control-label pull-left"><b>评语：</b></label>
		                        	<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
			                            <label class="col-md-4 control-label">总体评价</label>
			                            <div class="col-md-8">
			                                <textarea class="form-control" rows="3" id="content" name="content">{{ old('content') }}</textarea>

			                                @if ($errors->has('content'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('content') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>
		                        </div>
								<div class="col-md-2">
									<button type="submit"  class="btn btn-raised btn-danger" style="margin-top: 30px;">评论</button>
								</div>
							</form>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>

@endsection