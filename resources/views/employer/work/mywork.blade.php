@extends('layout.empmain')

@section('content')
<div class="container">
	<div class="work-choose">
		<div class="row">
	        <div class="col-lg-12">
	            <div role="tabpanel">
	                <!-- Nav tabs -->
	                <ul class="nav nav-tabs" role="tablist">
	                    <li role="presentation" class="active"><a href="#doing" aria-controls="doing" role="tab" data-toggle="tab">进行中</a></li>
	                    <li role="presentation"><a href="#checking" aria-controls="checking" role="tab" data-toggle="tab">审核中</a></li>
	                    <li role="presentation"><a href="#finished" aria-controls="finished" role="tab" data-toggle="tab">已结束</a></li>
	                </ul>
	                <div class="tab-content">
	                    <!-- 全部职位 -->
	                    <div role="tabpanel" class="tab-pane active" id="doing">
	                       <div class="row">
	                           <div class="col-lg-12">
	                           	@foreach ($works->where('applyable',1) as $work)
									@include('layout.empwork', ['work' => $work,'status'=>'doing'])
								@endforeach
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="checking">
	                        <div class="row">
	                           <div class="col-lg-12">
							    	@if(empty($works->where('checked',0)->all()))
								     <h4>该分类下暂时还没有兼职。</h4>
									@else
			                           	@foreach ($works->where('checked',0) as $work)
											@include('layout.empwork', ['work' => $work,'status'=>'checking'])
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="finished">
	                        <div class="row">
	                            <div class="col-lg-12">
	                            	@if(empty($works->where('finished',1)->all()))
								     <h4>该分类下暂时还没有兼职。</h4>
									@else
			                           	@foreach ($works->where('finished',1) as $work)
											@include('layout.empwork', ['work' => $work,'status'=>'finished'])
										@endforeach
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
<script type="text/javascript">
		function applyEnd(work_id)
		{
			$work_id = work_id;
		    $.ajax({
	            url  :"/work/apply/end",
	            type : 'post',
	            data : {
	                _token:"{{csrf_token()}}",
	                work_id:$work_id,
	            },
	            success : function (result,status,xhr) {
	            	alert(result.message);
		            	$("#ebtn"+$work_id).text("已结束");
		                $("#ebtn"+$work_id).attr("disabled","disabled");
		                $("#ebtn"+$work_id).css("color","red");
	            },
	            error: function(xhr,status,error){
	            	alert('出现了一些问题，请稍后再试');
	            }
	        });
		}

	</script> 
@endsection