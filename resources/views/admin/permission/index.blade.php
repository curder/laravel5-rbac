@extends('admin.layouts.base')
@section('content')
    <div class="col-md-10 col-sm-9">
        <div class="panel row">
            <div class="panel-heading">
                @if( IS_ROOT || Entrust::can('admin.permission.index') )<a href="{{ route('admin.permission.index') }}" class="disabled"> 权限管理 </a> &nbsp;@endif
                    @if( IS_ROOT || Entrust::can('admin.permission.create') )<a href="{{ route('admin.permission.create') }}" class=""> 新增权限 </a> &nbsp;@endif
            </div>
        </div><!--toolBar start-->
        <!-- 列表开始 -->
        @if($data->total() == 0)
            @include('layouts.empty',['info'=>sprintf('抱歉！没有找到数据..<a href="%s" >添加权限</a>',route('admin.permission.create'))] )
        @else
        <div class="panel row" id="admin-panel-list">
            <div class="panel-heading">
                <strong>权限管理</strong> <span class="pull-right">共 <strong>{{ $data->total() }}</strong> 记录</span>
            </div>
            <div class="panel-collapse">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">权限中文名</th>
                        <th class="text-center">权限英文名</th>
                        <th class="text-center">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $permission)
                        <tr id="tr_{{ $permission->id }}">
                            <td class="text-center">{{ $permission->id }}</td>
                            <td class="text-center"><a href="{{ route('admin.permission.getIndex',$permission->id) }}">{{ $permission->display_name }}</a></td>
                            <td class="text-center">{{ $permission->name }}</td>
                            <td class="text-center">
                                @if( IS_ROOT || Entrust::can('admin.permission.getCreate') )<a href="{{ route('admin.permission.getCreate',$permission->id) }}">新增子权限</a>&nbsp;@endif
                                @if( IS_ROOT || Entrust::can('admin.permission.edit') )<a href="{{ route('admin.permission.edit',$permission->id) }}">修改</a>&nbsp;@endif
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
        @endif
    </div>
@stop