@extends('layouts.admin')
@section('content')
<div class="col-md-10 col-sm-9">
    <div class="panel">
        <div class="panel-heading"> <strong>403 Forbidden</strong></div>

        <div class="panel-body">
            <h3 class="text-danger"><i class="icon icon-times"></i> 没有权限.</h3>

            <p>
                抱歉，你没有操作权限！
                此时你可以返回&nbsp;&nbsp;<a href="{{route('admin.index')}}">首页</a>&nbsp;&nbsp;或者&nbsp;&nbsp;<a href="{{$previousUrl}}">返回上一页</a>&nbsp;&nbsp;.
            </p>

        </div>
        <!-- /.error-content -->
    </div>
</div>
@stop