@extends('layout.empmain')
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
						<p>年  龄:
						@if(is_null($employer->age))
							未填写
						@else
							{{$employer->age}}</p>
						@endif
					</div>
					<div class="col-md-3">
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
						@if(Auth::guard('employers')->check() and Auth::guard('employers')->user()->id===$employer->id)
							<a href="/employer/info/{{$employer->id}}/edit" class="btn btn-raised btn-danger pull-right">完善个人资料</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default info-profile-panel">
			<p class="info-profile-header">我获得的成就</p>
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

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading"><b>我发布过的兼职</b></div>
			<div class="panel-body">
				@foreach($employer->works()->orderBy('created_at','desc')->get() as $work)
					<a href="/employer/work/info/{{$work->employer_id}}" class="pull-left">
						<img src="/image/employers/{{$employer->pic_path}}" alt="" class="image-rounded company-img">
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
					</div>
					<hr>
				@endforeach
			</div>

		</div>

	</div>
</div>

@endsection