<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>天天兼职</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->
		<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> -->
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/bootstrap-material-design.min.css">
		<link rel="stylesheet" href="/css/ripples.min.css">
		<link rel="stylesheet" href="/css/style.css">
		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/js/material.min.js"></script>
		<script type="text/javascript" src="/js/ripples.min.js"></script>
		<script type="text/javascript" src="/js/laravel-sms.js"></script>
		<script type="text/javascript" src="/js/bootstrap-hover-dropdown.min.js"></script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-success" role="navigation">
				<div class="container">
		        <!-- Brand and toggle get grouped for better mobile display -->
		        <div class="navbar-header">
		          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" >
		            <span class="nav-menu-name"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="">天天兼职</a>
		        </div>
		      
		        <!-- Collect the nav links, forms, and other content for toggling -->
		        <div class="collapse navbar-collapse navbar-ex1-collapse">
		          <ul class="nav navbar-nav">
		          	<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" style="font-size: 12px;" aria-expanded="false" data-hover="dropdown">深圳 <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">北京</a></li>
                                <li><a href="#">上海</a></li>
                                <li><a href="#">广州</a></li>
                                <li><a href="#">深圳</a></li>
                            </ul>
                    </li>
		            <li @if(Route::is('user_work') or Route::is('work_info')) class="active" @endif><a href="{{url('/user/work')}}">职位</a></li>
		            <li @if(Route::is('user_feed')) class="active" @endif><a href="">消息</a></li>

		        </ul>
		        <ul class="nav navbar-nav navbar-right">
					<li><a href="/employer/login">商家入口</a></li>
		            @if (Auth::check())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" data-hover="dropdown">
								<span class="caret pull-right nav-dropdown-icon"></span>
								<img class="circle" style="width:20px;height: 20px;" src="/image/users/{{ Auth::user()->pic_path }}" alt="{{ Auth::user()->name }}">
								<span class="nav-user-name">{{ Auth::user()->name }}</span> 
								
							</a>
							<ul class="dropdown-menu nav-dropdown-list" role="menu">
								
								<li><a href="/user/info/{{Auth::user()->id}}"><span class="glyphicon glyphicon-user"></span>个人资料</a></li>
								<li><a href="/user/mywork" class="reload-button"><span class="glyphicon glyphicon-briefcase"></span>我的兼职</a></li>
								<li><a href=""><span class="glyphicon glyphicon-comment"></span>我的私信</a></li>
								<li><a href="{{url('/user/logout')}}"><span class="glyphicon glyphicon-off"></span>退出登录</a></li>
							</ul>
						</li>	
										
					@else
						<li @if(Route::is('user_login')) class="active" @endif><a href="{{ url('/user/login') }}">登录</a></li>
						<li @if(Route::is('user_register')) class="active" @endif><a href="{{ url('/user/register')}}">注册</a></li>
					@endif
		          </ul>
		        </div><!-- /.navbar-collapse -->
		    </div>
		</nav>
		</header>
			<div class="container">
				@yield('content')
			</div>
		</div>
	</body>
	<script type="text/javascript">
		$.material.init();
	</script>
</html>