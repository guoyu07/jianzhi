@extends('layout.empmain')

@section('content')
<div class="container">
	 <div class="row">
	    <div class="col-lg-12">
	        <ol class="breadcrumb work-breadcrumb">
	            <li><a href="{{url('employer/work')}}">我的兼职</a></li>
	            <li class="active">{{$work->title}}</li>
	        </ol>
	    </div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default work-panel">
                <div class="panel-body">
                    <div class="pull-left">
                        <h4>{{$work->title}}<span>(发布日期：{{$work->created_at}})</span></h4>
                        <p>发布人：
                            <a href="/employer/info/{{$work->employer()->id}}"><i class="CoName_I" data-toggle="modal" data-target="#jobInfoDetail">{{$work->employer()->name}}</i></a>
                        </p>
                        <p>
                            <img src="http://images.static.100kuai.top/images/viewNum.png"/>
                            <span>浏览次数：{{$work->page_view}}次</span>
                        </p>
                    </div>
                    <button class="btn btn-default pull-right btn-raised btn-danger" type="submit">报名参加</button>
                    <input type="hidden" class="isFullTime" value="true"/>
                </div>
            </div>
        </div>
	</div>
	<div class="work-choose">
	    <div class="row">
	        <div class="col-lg-12">
	            <div role="tabpanel">
	                <!-- Nav tabs -->
	                <ul class="nav nav-tabs" role="tablist">
	                    <li role="presentation" class="active"><a href="#workInfo" role="tab" data-toggle="tab">兼职信息</a></li>
	                    <li role="presentation"><a href="#payInfo" role="tab" data-toggle="tab">支付信息</a></li>
	                    <li role="presentation"><a href="#interviewInfo" aria-controls="topPay" role="tab" data-toggle="tab">面试信息</a></li>
	                </ul>
	                
	              <!-- Tab panes -->
	                <div class="tab-content">
	                    <div role="tabpanel" class="tab-pane active" id="workInfo">
	                       <div class="row">
	                           <div class="col-md-10">
									<div class="row">
										<div class="col-md-6">
										<p>工作类型：{{$work->type}}</p></div>
										<div class="col-md-6"><p>兼职日期：{{$work->work_time}}</p></div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<p>招聘人次：{{$work->hired_num}}/{{$work->need_num}}</p></div>
										<div class="col-md-6">
										<p>工作午餐：{{$work->lunch}}</p></div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<p>性别要求：{{$work->gender}}</p></div>
										<div class="col-md-6">
										<p>工作地点：{{$work->district.$work->address}}</p></div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<p>工作内容：{{$work->description}}</p></div>
										<div class="col-md-6">
										<p>工作要求：{{$work->requirements}}</p></div>
									</div>
	                           </div>
	                       </div>
	                    </div>
	                    <div role="tabpanel" class="tab-pane" id="payInfo">
	                       <div class="row">
	                           <div class="col-md-10">
									<div class="row">
										<div class="col-md-6">
										<p>基本工资：{{$work->pay}}元/天</p></div>
										<div class="col-md-6"><p>提成方案：{{$work->commission}}</p></div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<p>支付方式：{{$work->pay_type}}</p></div>
										<div class="col-md-6">
										<p>结算时间：{{$work->pay_time}}</p></div>
									</div>
	                           </div>
	                       </div>
	                    </div>
                       <div role="tabpanel" class="tab-pane" id="interviewInfo">
	                       <div class="row">
	                           <div class="col-md-10">
									<div class="row">
										<div class="col-md-6">
										<p>面试时间：{{$work->interview_time}}</p></div>
										<div class="col-md-6"><p>面试地点：{{$work->interview_place}}</p></div>
									</div>
									<div class="row">
										<div class="col-md-6">
										<p>面试官：{{$work->interviewer}}</p></div>
										<div class="col-md-6">
										<p>联系方式：{{$work->contact}}</p></div>
									</div>
	                           </div>
	                       </div>
	                    </div>
	                </div>
	            </div>
	        </div>
        </div>
    </div>
    <div class="panel panel-primary question-panel" style="margin-top: 20px;">
    	<div class="panel-heading"><b>雇主答疑</b></div>
        <div class="panel-body">
        	<div class="list-group">
        		@if($work->questions()->count()>0)
        			@foreach($work->questions as $question )
        				<div class="list-group-item" style="margin-bottom: 20px;">
						    <div class="row-picture pull-left" style="margin-top: 10px;">
						      <a href="/employer/user/info/{{$question->user->id}}"><img class="circle" src="/image/users/{{$question->user->pic_path}}" alt="头像"></a>
						    </div>
						    <div class="row-content">
						      <a href="/employer/user/info/{{$question->user->id}}"><h4 class="list-group-item-heading">{{$question->user->name}}</h4></a>

						      <p class="list-group-item-text">{{$question->content}}</p>
						      <p><small>发布于：{{$question->created_at}}</small></p>
						    </div>
						    @if($question->answers)
							@foreach($question->answers as $answer)
							<div class="list-group-item" style="margin-bottom: 20px;">
						    <div class="row-picture pull-left" style="margin-top: 10px;">
						      <a href="/employer/info/{{$answer->employer_id}}"><img class="circle" src="/image/employers/{{$answer->employer->pic_path}}" alt="头像"></a>
						    </div>
						    <div class="row-content">
						      <a href="/employer/info/{{$answer->employer->id}}"><h4 class="list-group-item-heading">{{$answer->employer->name}}</h4></a>

						      <p class="list-group-item-text">{{$answer->content}}</p>
						      <p><small>回复于：{{$answer->created_at}}</small></p>
						    </div>
						    </div>
							    @endforeach
						    @endif
						    <form action="/employer/work/info/{{$question->id}}" method="post">
				        		{!! csrf_field() !!}
							    <div class="list-group-item">
							    <div class="row-picture pull-left" style="margin-top: 10px;">
				        		<img class="circle" src="/image/employers/{{ Auth::guard('employers')->user()->pic_path }}" alt="头像">
						    	</div>
							    	<div class="row-content">
							        	<h4 class="list-group-item-heading"> {{Auth::guard('employers')->user()->name}}，请输入你的回复</h4>
							      		<div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
				                            <div class="col-md-10">
				                            <input type="text" class="form-control" name="content" value="{{ $errors->first('content') }}">
				                            </div>
				                            <div class="col-md-2">
				                            <span class="input-group-btn">
				                                <button class="btn btn-default pull-right btn-raised btn-danger" type="submit">发表回复</button>
				                            </span>
				                            </div>
				                        </div>
							    	</div>
							    </div>
							    </form>
					    </div>
					@endforeach
				@else
				<h4>暂时还没有人提问</h4>
				@endif
        		
			</div>
        </div>
    </div>
    @if(!empty($work->comments->all()))
    	<div class="panel panel-primary" style="margin-top: 20px;">
    	<div class="panel-heading"><b>用户评价</b></div>
        <div class="panel-body">
        	<div class="list-group">
    			@foreach($work->comments as $comment)
    				<div class="col-md-2">
    					<a href="employer/user/info/{{$comment->user->id}}"><h5>{{$comment->user->name}}</h5></a>
					<a href="employer/user/info/{{$comment->user->id}}"><img src="/image/users/{{$comment->user->pic_path}}" style="width: 70px;height: 70px;" alt="{{$comment->user->name}}" class="avatar"></a>
    				</div>
    				<div class="col-md-2" style="margin-top: 20px;">
    					<p><span class="glyphicon glyphicon-thumbs-up"></span>点赞:{{$comment->user->up}}</p>
						<p><span class="glyphicon glyphicon-heart"></span>感谢:{{$comment->user->fans}}</p>
						<p><span class="glyphicon glyphicon-list-alt"></span>经验:{{$comment->user->exp}}</p>	
    				</div>
    				<div class="col-md-3" style="margin-top: 15px;">
						<h4>职位描述如实：{{$comment->description_stars}}/5</h4>
						<h4>工资待遇如实：{{$comment->pay_stars}}/5</h4>
						<h4>工资发放速度：{{$comment->payspeed_stars}}/5</h4>
					</div>
					<div class="col-md-3" style="margin-top: 15px;">
						<h4>总体评价：{{$comment->content}}</h4>
						<small>评论于：{{$comment->created_at}}</small>
					</div>
				@endforeach
			</div>
		</div>
	@endif

@endsection