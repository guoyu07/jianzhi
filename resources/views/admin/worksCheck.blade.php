@extends('admin.layout.main')
@section('content')
<div class="admin-content">
    <div class="admin-content-body">
    	<div class="am-cf am-padding am-padding-bottom-0">
        	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">待审核兼职</strong> / <small>Jobs for checking</small></div>
        </div>
        <hr>
        <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">标题</th><th class="table-type">类别</th><th class="table-author am-hide-sm-only">商家</th><th class="table-date am-hide-sm-only">修改日期</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              @if(empty($works->all()))
              <tr style="font-size: 20px;text-align: center;"><td colspan="7"><b>暂时还没兼职等待审核</b></td></tr></tbody>
              @else
              	@foreach($works as $work)
              <tr>
                <td><input type="checkbox" /></td>
                <td>{{$work->id}}</td>
                <td><a href="">{{$work->title}}</a></td>
                <td class="am-hide-sm-only">{{$work->type}}</td>
                <td>{{$work->employer()->name}}</td>
                <td class="am-hide-sm-only">{{$work->created_at}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="passCheck({{$work->id}},1)"><span class="am-icon-pencil-square-o"></span> 通过</button>
                      <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only" onclick="passCheck({{$work->id}},0)"><span class="am-icon-copy"></span>拒绝</button>
                    </div>
                  </div>
                </td>
              </tr>
              	@endforeach
          	@endif
              </tbody>
            </table>
        </form>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    function passCheck(work_id,status)
    {
      $work_id = work_id;
      $status   = status;
        $.ajax({
              url  :"/admin/works/check/",
              type :'post',
              data : {
                  _token:"{{csrf_token()}}",
                  work_id:$work_id,
                  status:$status,
              },
              success : function (result,status,xhr) {
                alert(result.message);
              },
              error: function(xhr,status,error){
                alert('出现了问题，请稍后再试');
              }
          });
    }
</script>

@endsection