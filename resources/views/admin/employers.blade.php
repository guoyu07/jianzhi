@extends('admin.layout.main')
@section('content')
<div class="admin-content">
    <div class="admin-content-body">
    	<div class="am-cf am-padding am-padding-bottom-0">
        	<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">所有商家</strong><small>All employers</small></div>
        </div>
        <hr>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
          <div class="am-btn-toolbar">
            <div class="am-btn-group am-btn-group-xs">
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-form-group">
            <select id="type" class="form-control" name="type">
              <option @if(old('type')==='全部') selected = "selected" @endif>全部</option>
              <option @if(old('type')==='男') selected = "selected" @endif>男</option>
              <option @if(old('type')==='女') selected = "selected" @endif>女</option>        
            </select>
          </div>
        </div>
        <div class="am-u-sm-12 am-u-md-3">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field">
          <span class="am-input-group-btn">
            <button class="am-btn am-btn-default" type="button">搜索</button>
          </span>
          </div>
        </div>
      </div>

        <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">姓名</th><th class="table-type">性别</th><th class="table-author am-hide-sm-only">年龄</th><th class="table-date am-hide-sm-only">加入时间</th><th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              @if(empty($employers->all()))
              <tr style="font-size: 20px;text-align: center;"><td colspan="7"><b>暂时还没用户</b></td></tr></tbody>
              @else
              	@foreach($employers->sortBydesc('created_at') as $employer)
              <tr>
                <td><input type="checkbox" /></td>
                <td>{{$employer->id}}</td>
                <td><a href="/employer/info/{{$employer->id}}">{{$employer->name}}</a></td>
                <td class="am-hide-sm-only">{{$employer->gender}}</td>
                <td>{{$employer->age}}</td>
                <td class="am-hide-sm-only">{{$employer->created_at}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                      <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button>
                      <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</button>
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


@endsection