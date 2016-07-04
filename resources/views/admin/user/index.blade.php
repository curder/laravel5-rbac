@extends('admin.layouts.base')
@section('content')
<div class="col-md-10 col-sm-9">
    <div class="panel row">
        <div class="panel-heading">
            @if( IS_ROOT || Entrust::can('admin.user.index') )<a href="{{ route('admin.user.index') }}" class="disabled"> 用户管理 </a> &nbsp;@endif
            @if( IS_ROOT || Entrust::can('admin.user.create') )<a href="{{ route('admin.user.create') }}" class=""> 新增用户 </a> &nbsp;@endif
        </div>
    </div><!--toolBar start-->
    <!-- 列表开始 -->
    <div class="panel row" id="admin-panel-list">
        <div class="panel-heading">
            <strong>用户管理</strong> <span class="pull-right">共 <strong>{{ $data->total() }}</strong> 记录</span>
        </div>
        <div class="panel-collapse">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th class="text-center">
                        UID
                    </th>
                    <th class="text-center">
                        用户名
                    </th>
                    <th class="text-center">
                        最后登录时间
                    </th>
                    <th class="text-center">
                        用户状态
                    </th>
                    <th class="text-center">
                        操作
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $user)
                    <tr id="tr_{{ $user->id }}">
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->updated_at }}</td>
                        <td class="text-center">
                            {!! $user->status_str !!}
                        </td>
                        <td class="text-center">
                            @if( IS_ROOT || Entrust::can('admin.user.edit') )<a href="{{ route('admin.user.edit',$user->id) }}">修改密码</a>&nbsp;@endif
                            @if( IS_ROOT || Entrust::can('admin.user.getGroup') )<a href="{{ route('admin.user.getGroup',$user->id) }}" > 授权</a>&nbsp;@endif
                            {{--<a href="/backend.php/User/changeStatus/status/forbid/ids/2/model/User.html" class="jsoner">禁用</a>&nbsp;
                            <a href="/backend.php/User/changeStatus/status/delete/ids/2/model/User.html" class="deleter">删除</a>&nbsp;--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {!! $data->render() !!}
            </div>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
@stop