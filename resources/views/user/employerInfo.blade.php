@extends('layout.usermain')
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default info-profile-panel">
			<p class="info-profile-header">{{$employer->name}}</p>
			<div class="row">
				<div class="col-md-2">
					<img src="/image/employers/{{$employer->pic_path}}" alt="{{$employer->name}}" class="avatar">
				</div>
				<div class="col-md-10">
					<div class="col-md-3">
						<p>性别:
						@if(is_null($employer->gender))
							未填写
						@else
							{{$employer->gender}}</p>
						@endif
						<p>学校:
						@if(is_null($employer->school))
							未填写
						@else
							{{$employer->school}}</p>
						@endif
						<p>专业:
						@if(is_null($employer->major))
							未填写
						@else
							{{$employer->major}}</p>
						@endif
					</div>
					<div class="col-md-3">
						<p>年  龄:
						@if(is_null($employer->age))
							未填写
						@else
							{{$employer->age}}</p>
						@endif
						<p>所在城市:
						@if(is_null($employer->city))
							未填写
						@else
							{{$employer->city}}</p>
						@endif
						<p>个人简介:
						@if(is_null($employer->introduction))
							未填写
						@else
							{{$employer->introduction}}</p>
						@endif
					</div>
					<div class="col-md-6">
							<a href="" class="btn btn-raised btn-danger pull-right">关注</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default info-profile-panel">
			<p class="info-profile-header">他获得的成就</p>
			<div class="row" style="font-size: 18px;  text-align: center;">
				<div class="col-md-4" style="cursor: pointer;">
					<span class="glyphicon glyphicon-thumbs-up"></span>点赞
				</div>
				<div class="col-md-4" style="cursor: pointer;">
					<span class="glyphicon glyphicon-heart"></span>感谢
				</div>
				<div class="col-md-4">
					<span class="glyphicon glyphicon-list-alt"></span>经验
				</div>
			</div>
			<div class="row" style="font-size: 18px; text-align: center;">
				<div class="col-md-4" style="cursor: pointer;">
					{{$employer->up}}
				</div>
				<div class="col-md-4" style="cursor: pointer;">
					{{$employer->fans}}
				</div>
				<div class="col-md-4">
					{{$employer->exp}}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="work-choose">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="pull-right"><a href="#finished" aria-controls="finished" role="tab" data-toggle="tab">已结束</a></li>
            <li role="presentation" class="pull-right"><a href="#going" aria-controls="going" role="tab" data-toggle="tab">进行中</a></li>
            <li role="presentation" class="pull-letf"><a><b>他发布过的兼职</b></a></li>
        </ul>
        <div class="tab-content">
            <!-- 全部职位 -->
            <div role="tabpanel" class="tab-pane active" id="going">
               <div class="panel-body">
				@foreach($employer->works()->where('applyable',1)->orderBy('created_at','desc')->get() as $work)
					<a href="/user/employer/info/{{$work->employer_id}}" class="pull-left">
						<img src="/image/employers/{{$employer->pic_path}}" alt="" class="image-rounded company-img">
					</a>
					<div class="row">
						<div class="col-md-6 pull-left">
							<a href="/work/info/{{$work->id}}"><h4 class="work-name">【{{$work->type}}】{{$work->title}}</h4></a>
							<div class="row">
								<div class="col-md-5"><span class="glyphicon glyphicon-user"></span>招聘人次：{{$work->hired_num}}/{{$work->need_num}}</div>
								<div class="col-md-7"><span class="glyphicon glyphicon-time"></span>工作时间：{{$work->work_time}}</div>
							</div>
							<div class="row">
								<div class="col-md-5"><span class="glyphicon glyphicon-modal-window"></span>结算方式：{{$work->pay_type}}/{{$work->pay_time}}</div>
								<div class="col-md-7"><span class="glyphicon glyphicon-map-marker"></span>工作地点：{{$work->district.$work->address}}</div>
							</div>
						</div>
						<div class="col-md-3 pull-right" style="margin-top: 20px;">
						@if(Auth::check())
							@if(Auth::user()->works_applying()->contains('id',$work->id))
								<button  class="btn btn-raised btn-danger" disabled="disabled"
								style="color:red;">已申请</button>
							@elseif(Auth::user()->works_passed()->contains('id',$work->id))
								<button  class="btn btn-raised btn-danger" disabled="disabled"
								style="color:red;">已通过</button>
							@elseif(Auth::user()->works_rejected()->contains('id',$work->id))
								<button  class="btn btn-raised btn-danger" disabled="disabled"
								style="color:red;">不通过</button>
							@elseif(Auth::user()->works_finished()->contains('id',$work->id))
								@if($work->commentOnUser(Auth::user()->id))
								<button class="btn btn-raised btn-danger" disabled="disabled" style="color: red;">已评价</button>
								@else
								<a href="/user/comment/{{$work->id}}" class="btn btn-raised btn-danger">评价兼职</a>
								@endif
							@else
								<button  class="btn btn-raised btn-danger" id="btn{{$work->id}}" onclick="applyJob({{$work->id}})"><span id="btn-icon"></span>申请兼职</button>
							@endif
						@else
							<button  class="btn btn-raised btn-danger" id="btn{{$work->id}}" onclick="applyJob({{$work->id}})"><span id="btn-icon"></span>申请兼职</button>
						@endif
						</div>
					</div>
					<hr>
				@endforeach
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="finished">
               <div class="panel-body">
				@foreach($employer->works()->where('finished',1)->orderBy('created_at','desc')->get() as $work)
					<a href="/user/employer/info/{{$work->employer_id}}" class="pull-left">
						<img src="/image/employers/{{$employer->pic_path}}" alt="" class="image-rounded company-img">
					</a>
					<div class="row">
						<div class="col-md-6 pull-left">
							<a href="/work/info/{{$work->id}}"><h4 class="work-name">【{{$work->type}}】{{$work->title}}</h4></a>
							<div class="row">
								<div class="col-md-5"><span class="glyphicon glyphicon-user"></span>招聘人次：{{$work->hired_num}}/{{$work->need_num}}</div>
								<div class="col-md-7"><span class="glyphicon glyphicon-time"></span>工作时间：{{$work->work_time}}</div>
							</div>
							<div class="row">
								<div class="col-md-5"><span class="glyphicon glyphicon-modal-window"></span>结算方式：{{$work->pay_type}}/{{$work->pay_time}}</div>
								<div class="col-md-7"><span class="glyphicon glyphicon-map-marker"></span>工作地点：{{$work->district.$work->address}}</div>
							</div>
						</div>
						<div class="col-md-4 pull-right">
							<h4>兼职评价</h4>
							@if(empty($work->comments()->get()->all()))
								<p>暂时还没有评价</p>
							@else
							<p>{{$work->comments()->first()->content}}</p>
							<small>{{$work->comments()->first()->created_at}}</small>
							@endif
						</div>
					</div>
					<hr>
				@endforeach
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	@if(Auth::check())
		function applyJob(work_id)
		{
			$work_id = work_id;
		    $.ajax({
	            url  :"/work/info/"+$work_id,
	            type : 'post',
	            data : {
	                _token:"{{csrf_token()}}",
	                work_id:$work_id,
	                user_id:"{{Auth::user()->id}}",
	            },
	            success : function (result,status,xhr) {
	            	alert(result.message);
	            	$("#btn"+$work_id).text("已申请");
	                $("#btn"+$work_id).attr("disabled","disabled");
	                $("#btn"+$work_id).css("color","red");
	            },
	            error: function(xhr,status,error){
	            	alert('error.message');
	            }
	        });
		}
	@else
		function applyJob(work_id)
		{
        	alert('您还没登录，请先登录');
    	}
	@endif
</script>
@endsection