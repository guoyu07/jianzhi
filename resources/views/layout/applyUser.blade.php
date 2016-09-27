<div class="panel panel-default info-profile-panel">
	<div class="row">
		<div class="col-md-1">
			<a href="/employer/user/info/{{$user->id}}"><h5>{{$user->name}}</h5></a>
			<a href="/employer/user/info/{{$user->id}}"><img src="/image/users/{{$user->pic_path}}" style="width: 70px;height: 70px;" alt="{{$user->name}}" class="avatar"></a>
		</div>
		<div class="col-md-8">
			<div class="row" style="font-size: 18px;  text-align: center;">
				<div class="col-md-4" style="cursor: pointer;">
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
				<div class="col-md-4">
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
				<div class="col-md-4">
					<p><span class="glyphicon glyphicon-thumbs-up"></span>点赞:{{$user->up}}</p>
					<p><span class="glyphicon glyphicon-heart"></span>感谢:{{$user->fans}}</p>
					<p><span class="glyphicon glyphicon-list-alt"></span>经验:{{$user->exp}}</p>
				</div>
			</div>
		</div>
		<div class="col-md-2">
			@if($status==='unchecked')
				<button href="" class="btn btn-raised btn-danger pull-right" id="pbtn{{$user->id}}{{$work->id}}" onclick="applyPass({{$user->id}},{{$work->id}},1)">同意</button>
				<button href=""  class="btn btn-raised btn-danger pull-right" id="dbtn{{$user->id}}{{$work->id}}" onclick="applyPass({{$user->id}},{{$work->id}},0)">拒绝</button>
			@endif
		</div>
	</div>
</div>