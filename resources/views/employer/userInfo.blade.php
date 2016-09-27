@extends('layout.empmain')

@section('content')

<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default info-profile-panel">
			<p class="info-profile-header">{{$user->name}}</p>
			<div class="row">
				<div class="col-md-2">
					<img src="/image/users/{{$user->pic_path}}" alt="{{$user->name}}" class="avatar">
				</div>
				<div class="col-md-10">
					<div class="col-md-3">
						<p>性别:
						@if(is_null($user->gender))
							未填写
						@else
							{{$user->gender}}</p>
						@endif
						<p>学校:
						@if(is_null($user->school))
							未填写
						@else
							{{$user->school}}</p>
						@endif
						<p>专业:
						@if(is_null($user->major))
							未填写
						@else
							{{$user->major}}</p>
						@endif
					</div>
					<div class="col-md-3">
						<p>年  龄:
						@if(is_null($user->age))
							未填写
						@else
							{{$user->age}}</p>
						@endif
						<p>所在城市:
						@if(is_null($user->city))
							未填写
						@else
							{{$user->city}}</p>
						@endif
						<p>个人简介:
						@if(is_null($user->introduction))
							未填写
						@else
							{{$user->introduction}}</p>
						@endif
					</div>
					<div class="col-md-6">
							<a href="" class="btn btn-raised btn-danger pull-right">添加好友</a>
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
					{{$user->up}}
				</div>
				<div class="col-md-4" style="cursor: pointer;">
					{{$user->fans}}
				</div>
				<div class="col-md-4">
					{{$user->exp}}
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading"><b>他做过的兼职</b></div>
			<div class="panel-body">
				@foreach($user->works_passed() as $work)
					<a href="/employer/info/{{$work->employer_id}}" class="pull-left">
						<img src="/image/employers/{{$work->employer->pic_path}}" alt="" class="image-rounded company-img">
					</a>
					<div class="row">
						<div class="col-md-6 pull-left">
							<a href="/employer/work/info/{{$work->id}}"><h4 class="work-name">【{{$work->type}}】{{$work->title}}</h4></a>
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
							<h4>雇主评价</h4>
							<p>哈哈哈哈啊哈哈</p>
						</div>
					</div>
					<hr>
				@endforeach
			</div>

		</div>

	</div>
</div>

@endsection