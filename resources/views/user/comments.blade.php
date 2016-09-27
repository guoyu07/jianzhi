@extends('layout.usermain')
@section('content')
<div class="panel panel-primary">
		<div class="panel-heading"><b>{{$work->title}}--兼职评价</b></div>
		<div class="panel-body">
				<div class="row">
				<div class="col-md-1">
					<a href="/user/employer/info/{{$employer->id}}"><h5>{{$employer->name}}</h5></a>
					<a href="/user/employer/info/{{$employer->id}}"><img src="/image/employers/{{$employer->pic_path}}" style="width: 70px;height: 70px;" alt="{{$employer->name}}" class="avatar"></a>
				</div>
				<div class="col-md-11">
					<div class="row" style="font-size: 18px;  text-align: center;">
						<div class="col-md-2"  style="margin-top: 15px;">
							<p><span class="glyphicon glyphicon-thumbs-up"></span>点赞:{{$employer->up}}</p>
							<p><span class="glyphicon glyphicon-heart"></span>感谢:{{$employer->fans}}</p>
							<p><span class="glyphicon glyphicon-list-alt"></span>经验:{{$employer->exp}}</p>	
						</div>
						<div class="col-md-10">
							@if($work->commentOnUser(Auth::user()->id))
								<div class="col-md-4 " style="margin-top: 15px;">
									<h4>职位描述如实：{{$work->commentOnUser(Auth::user()->id)->description_stars}}/5</h4>
									<h4>工资待遇如实：{{$work->commentOnUser(Auth::user()->id)->pay_stars}}/5</h4>
									<h4>工资发放速度：{{$work->commentOnUser(Auth::user()->id)->payspeed_stars}}/5</h4>
								</div>
								<div class="col-md-4" style="margin-top: 15px;">
									<h4>总体评价：{{$work->commentOnUser(Auth::user()->id)->content}}</h4>
								</div>
								<div class="col-md-4">
									<button type="submit"  class="btn btn-raised btn-danger" style="margin-top: 30px;color: red;" disabled="disabled">已评论</button>
								</div>
							@else
							<form action="/user/comment/{{$work->id}}" method="post">
								{!! csrf_field() !!}
								<div class="col-md-5">
									<label class="col-md-12 control-label pull-left"><b>评分：(分数越高代表表现越好）</b></label>
									<div class="form-group">
			                            <label class="col-md-4 control-label">职位描述如实</label>
			                            <div class="col-md-8">
			                            <select id="description_stars" class="form-control" name="description_stars">
			                                  <option @if(old('description_stars')==='1') selected = "selected" @endif>1</option>
			                                  <option @if(old('description_stars')==='2') selected = "selected" @endif>2</option>
			                                  <option @if(old('description_stars')==='3') selected = "selected" @endif>3</option>
			                                  <option @if(old('description_stars')==='4') selected = "selected" @endif>4</option> 
			                                  <option @if(old('description_stars')==='5') selected = "selected" @endif>5</option>      
			                                </select>
			                            </div>
			                        </div>
			                        <div class="form-group">
			                            <label class="col-md-4 control-label">工资待遇如实</label>
			                            <div class="col-md-8">
			                            <select id="pay_stars" class="form-control" name="pay_stars">
			                                  <option @if(old('pay_stars')==='1') selected = "selected" @endif>1</option>
			                                  <option @if(old('pay_stars')==='2') selected = "selected" @endif>2</option>
			                                  <option @if(old('pay_stars')==='3') selected = "selected" @endif>3</option>
			                                  <option @if(old('pay_stars')==='4') selected = "selected" @endif>4</option> 
			                                  <option @if(old('pay_stars')==='5') selected = "selected" @endif>5</option>      
			                                </select>
			                            </div>
			                        </div>
		                        </div>
		                        <div class="col-md-5">
		                        	<label class="col-md-4 control-label pull-left"><b>评语：</b></label>
			                        <div class="form-group">
			                            <label class="col-md-4 control-label">工资发放速度</label>
			                            <div class="col-md-8">
			                            <select id="payspeed_stars" class="form-control" name="payspeed_stars">
			                                  <option @if(old('payspeed_stars')==='1') selected = "selected" @endif>1</option>
			                                  <option @if(old('payspeed_stars')==='2') selected = "selected" @endif>2</option>
			                                  <option @if(old('payspeed_stars')==='3') selected = "selected" @endif>3</option>
			                                  <option @if(old('payspeed_stars')==='4') selected = "selected" @endif>4</option> 
			                                  <option @if(old('payspeed_stars')==='5') selected = "selected" @endif>5</option>      
			                                </select>
			                            </div>
			                        </div>
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
		</div>
	</div>

@endsection