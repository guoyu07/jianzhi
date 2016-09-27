@extends('admin.layout.main')
@section('content')
<div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">首页</strong> / <small>数据统计</small></div>
      </div>

      <ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
        <li><a href="/admin/works" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>兼职数量<br/>{{$works->count()}}</a></li>
        <li><a href="/admin/employers" class="am-text-warning"><span class="am-icon-btn am-icon-briefcase"></span><br/>商家数量<br/>{{$employers->count()}}</a></li>
        <li><a href="/admin/users" class="am-text-danger"><span class="am-icon-btn am-icon-user-md"></span><br/>用户数量<br/>{{$users->count()}}</a></li>
        <li><a href="#" class="am-text-secondary"><span class="am-icon-btn am-icon-recycle"></span><br/>访问量<br/>{{$works->sum('page_view')}}</a></li>
      </ul>
    </div>
</div>

@endsection