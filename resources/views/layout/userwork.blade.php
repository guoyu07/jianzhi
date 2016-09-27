<div class="panel panel-default work-panel-main">
	<div class="panel-body">
		<a href="/user/employer/info/{{$work->employer_id}}" class="pull-left">
			<img src="/image/employers/{{$work->employer()->pic_path}}" alt="" class="image-rounded company-img">
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
				<div class="col-md-6 pay-body">
					<span class="pay-money">{{$work->pay}}</span>元/天
				</div>
				<div class="col-md-6" style="margin-top: 20px;">
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
		</div>
	</div>
</div>