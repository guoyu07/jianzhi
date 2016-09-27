@extends('layout.empmain')

@section('content')
	@foreach(Auth::guard('employers')->user()->works()->where('applyable',1)->get() as $work)
		@if(!empty($work->users()->all()))
			<div class="work-choose">
	            <div role="tabpanel">
	                <!-- Nav tabs -->
	                <ul class="nav nav-tabs" role="tablist">
	                    <li role="presentation" class="pull-right"><a href="#rejected{{$work->id}}" aria-controls="rejected{{$work->id}}" role="tab" data-toggle="tab">已拒绝</a></li>
	                    <li role="presentation" class="pull-right"><a href="#passed{{$work->id}}" aria-controls="passed{{$work->id}}" role="tab" data-toggle="tab">已同意</a></li>
	                    <li role="presentation" class="active pull-right"><a href="#unchecked{{$work->id}}" aria-controls="unchecked{{$work->id}}" role="tab" data-toggle="tab">未确认</a></li>
	                    <li role="presentation" class="pull-letf"><a><b>{{$work->title}}--申请人列表</b></a></li>
	                </ul>
	                <div class="tab-content">
	                    <!-- 全部职位 -->
	                    <div role="tabpanel" class="tab-pane active" id="unchecked{{$work->id}}">
	                       <div class="panel-body">
	                           <div class="col-lg-12">
							    	@if(empty($work->users_unchecked()->all()))
								     <h4>暂时还没有确认了的申请人</h4>
									@else
			                           	@foreach ($work->users_unchecked() as $user)
											@include('layout.applyUser',['user'=>$user,'status'=>'unchecked','work'=>$work])
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="passed{{$work->id}}">
	                        <div class="panel-body">
	                           <div class="col-lg-12">
							    	@if(empty($work->users_passed()->all()))
								     <h4>暂时还没有确认了的申请人</h4>
									@else
			                           	@foreach ($work->users_passed() as $user)
											@include('layout.applyUser',['user'=>$user,'status'=>'passed'])
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="rejected{{$work->id}}">
	                        <div class="panel-body">
	                            <div class="col-lg-12">
	                            	@if(empty($work->users_rejected()->all()))
								     <h4>暂时还没有人被拒绝</h4>
									@else
			                           	@foreach ($work->users_rejected() as $user)
											@include('layout.applyUser',['user'=>$user,'status'=>'rejected'])
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		<hr>
	@endforeach
	<script type="text/javascript">
		function applyPass(user_id,work_id,status)
		{
			$user_id = user_id;
			$work_id = work_id;
			$status  = status;
		    $.ajax({
	            url  :" /work/apply/decide",
	            type : 'post',
	            data : {
	                _token:"{{csrf_token()}}",
	                user_id:$user_id,
	                work_id:$work_id,
	                status:$status,
	            },
	            success : function (result,status,xhr) {
	            	alert(result.message);
	            	if ($status) {
		            	$("#pbtn"+$user_id+$work_id).text("已同意");
		                $("#pbtn"+$user_id+$work_id).attr("disabled","disabled");
		                $("#pbtn"+$user_id+$work_id).css("color","red");
		                $("#dbtn"+$user_id+$work_id).attr("disabled","disabled");
	                }else{
	                	$("#dbtn"+$user_id+$work_id).text("已拒绝");
		                $("#dbtn"+$user_id+$work_id).attr("disabled","disabled");
		                $("#dbtn"+$user_id+$work_id).css("color","red");
		                $("#pbtn"+$user_id+$work_id).attr("disabled","disabled");
	                }
	            },
	            error: function(xhr,status,error){
	            	alert('error.message');
	            }
	        });
		}

	</script>
@endsection