@extends('layout.usermain')

@section('content')
<div class="container">
	<div class="work-choose">
		<div class="row">
	        <div class="col-lg-12">
	            <div role="tabpanel">
	                <!-- Nav tabs -->
	                <ul class="nav nav-tabs" role="tablist">
	                    <li role="presentation" class="active"><a href="#applying" aria-controls="applying" role="tab" data-toggle="tab">申请中</a></li>
	                    <li role="presentation"><a href="#passed" aria-controls="passed" role="tab" data-toggle="tab">已通过</a></li>
	                    <li role="presentation"><a href="#unpassed" aria-controls="unpassed" role="tab" data-toggle="tab">不通过</a></li>
	                    <li role="presentation"><a href="#finished" aria-controls="finished" role="tab" data-toggle="tab">已结束</a></li>
	                </ul>
	                <div class="tab-content">
	                    <!-- 全部职位 -->
	                    <div role="tabpanel" class="tab-pane active" id="applying">
	                       <div class="row">
	                           <div class="col-lg-12">
	                           	@if(empty(Auth::user()->works_applying()->all()))
								     <h4>您暂时还没申请有兼职</h4>
								@else
	                           	@foreach (Auth::user()->works_applying() as $work)
									@include('layout.userwork', ['work' => $work])
								@endforeach
								@endif
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="passed">
	                        <div class="row">
	                           <div class="col-lg-12">
							    	@if(empty(Auth::user()->works_passed()->all()))
								     <h4>您暂时还没有兼职通过申请</h4>
									@else
			                           	@foreach (Auth::user()->works_passed() as $work)
											@include('layout.userwork', ['work' => $work])
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="unpassed">
	                        <div class="row">
	                            <div class="col-lg-12">
	                            	@if(empty(Auth::user()->works_rejected()->all()))
								     <h4>您暂时还没有兼职被拒绝</h4>
									@else
			                           	@foreach (Auth::user()->works_rejected() as $work)
											@include('layout.userwork', ['work' => $work])
										@endforeach
									@endif
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="finished">
	                        <div class="row">
	                            <div class="col-lg-12">
	                            	@if(empty(Auth::user()->works_finished()->all()))
								     <h4>您暂时还没有已经结束的兼职</h4>
									@else
			                           	@foreach (Auth::user()->works_finished() as $work)
											@include('layout.userwork', ['work' => $work])
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
@endsection