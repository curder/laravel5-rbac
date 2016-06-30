@extends('layouts.admin')
@section('content')
    <div class="col-md-10 col-sm-9">
        <div class="panel row">
            <div class="panel-heading">
                <a href="{{ route('permission.index') }}" class="disabled"><strong> 权限管理 </strong></a> &nbsp;
                <a href="{{ route('permission.create') }}" class=""><strong> 新增权限</strong></a> &nbsp;
            </div>
        </div><!--toolBar start-->
        <!-- 列表开始 -->
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
                            <td class="text-center"><a href="{{ route('permission.index',$permission->id) }}">{{ $permission->display_name }}</a></td>
                            <td class="text-center">{{ $permission->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('permission.create',$permission->id) }}">新增子权限</a>&nbsp;
                                <a href="{{ route('permission.edit',$permission->id) }}">修改</a>&nbsp;
                                <a href="/backend.php/User/changeStatus/status/forbid/ids/2/model/User.html" class="jsoner">禁用</a>&nbsp;
                                <a href="/backend.php/User/changeStatus/status/delete/ids/2/model/User.html" class="deleter">删除</a>&nbsp;
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