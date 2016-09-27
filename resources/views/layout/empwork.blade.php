<div class="panel panel-default work-panel-main" id="{{$work->id}}">
		<div class="panel-body">
			<a href="/employer/work/info/{{Auth::guard('employers')->user()->id}}" class="pull-left">
				<img src="/image/employers/{{Auth::guard('employers')->user()->pic_path}}" alt="" class="image-rounded company-img">
			</a>
			<div class="row">
				<div class="col-md-6 pull-left">
					<a href="/employer/work/info/{{$work->id}}"><h4 class="work-name">【{{$work->type}}】{{$work->title}}</h4></a>
					<div class="row">
						<div class="col-md-4">招聘人次：{{$work->hired_num}}/{{$work->need_num}}</div>
						<div class="col-md-8">工作时间：{{$work->work_time}}</div>
					</div>
					<div class="row">
						<div class="col-md-4">结算方式：{{$work->pay_type}}/{{$work->pay_time}}</div>
						<div class="col-md-8">工作地点：{{$work->district.$work->address}}</div>
					</div>
				</div>
				<div class="col-md-4 pull-right">
					<div class="col-md-6 pay-body">
						<span class="pay-money">{{$work->pay}}</span>元/天
					</div>
					<div class="col-md-6">
						@if($status==='doing')
							<button class="btn btn-raised btn-danger" style="margin-top: 30px;" id="ebtn{{$work->id}}" onclick="applyEnd({{$work->id}})">报名结束</button>
						@elseif($status==='checking')
							<a href="/employer/work/{{$work->id}}/edit" class="btn btn-raised btn-danger">修改兼职</a>
							<button href="javascript:void(0)" class="btn btn-raised btn-danger">取消发布</button>
						@elseif($status==='finished')
							<a href="/employer/comment/{{$work->id}}" class="btn btn-raised btn-danger" style="margin-top: 30px;" onclick="">评价申请人</a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>