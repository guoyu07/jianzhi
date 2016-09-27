@extends('layout.usermain')

@section('content')

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="work-select">
				<div class="row">
					<div class="col-lg-12 work-selectType">
		                <p class="pull-left ">
		                    <span>职位：</span>
		                </p>
		                <ul class="list-inline pull-left">
		                    <li class="active">全部</li>
		                    <li class="1">礼仪模特</li>  
		                    <li class="2">老师家教</li> 
		                    <li class="3">促销导购</li> 
		                    <li class="4">话务客服</li> 
		                    <li class="5">传单派发</li> 
		                    <li class="6">审核录入</li> 
		                    <li class="7">服务员</li> 
		                    <li class="8">问卷调查</li>
		                    <li class="9">地推拉访</li> 
		                    <li class="10">其他</li> 
		                </ul>
		            </div>
		        </div>
		        <hr/>
		        <div class="row">
		            <div class="col-lg-12 work-selectArea">
		                <p class="pull-left">
		                    <span>区域：</span>
		                </p>
		                <ul class="list-inline pull-left">
		                    <li class="active">全部</li>
		                    	<li class="320104">福田区</li>
		                    	<li class="320106">罗湖区</li>
		                    	<li class="320102">南山区</li>
		                    	<li class="320114">宝安区</li>
		                    	<li class="320105">龙岗区</li>
		                    	<li class="320113">光明新区</li>
		                    	<li class="320115">坪山新区</li>
		                    	<li class="320111">龙华新区</li>
		                    	<li class="320116">大鹏新区</li>
		                </ul>
		            </div>
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
                            <li role="presentation" class="active"><a href="#allJob" aria-controls="allJob" role="tab" data-toggle="tab">全部职位</a></li>
                            <li role="presentation"><a href="#hotJob" aria-controls="hotJob" role="tab" data-toggle="tab">最多关注</a></li>
                            <li role="presentation"><a href="#topPay" aria-controls="topPay" role="tab" data-toggle="tab">待遇最好</a></li>
                            <form action="##" class="navbar-form pull-right" rol="search" onsubmit="return false;">
                                <div class="form-group">
                                    <input id="searchInput" type="text" class="form-control" value="" placeholder="请输入关键词"/>
                                    <span id="searchJob" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </div>
                            </form>
                        </ul>
                        <div class="tab-content">
                            <!-- 全部职位 -->
                            <div role="tabpanel" class="tab-pane active" id="allJob">
                               <div class="row">
                                   <div class="col-lg-12">
                                   	@foreach ($works as $work)
										@include('layout.userwork', ['work' => $work])
									@endforeach
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="hotJob">
                               <div class="row">
                                   <div class="col-lg-12">
                                   	@foreach ($works->sortByDesc('page_view') as $work)
										@include('layout.userwork', ['work' => $work])
									@endforeach
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="topPay">
                               <div class="row">
                                   <div class="col-lg-12">
                                   	@foreach ($works->sortByDesc('pay') as $work)
										@include('layout.userwork', ['work' => $work])
									@endforeach
								</div>
							</div>
						</div>
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
                                       
</div>
@endsection