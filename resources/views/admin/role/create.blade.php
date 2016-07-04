@extends('admin.layouts.base')
@section('content')
    <div class="col-md-10 col-sm-9">
        <div class="panel row">
            <div class="panel-heading">
                <a href="{{ route('admin.role.create') }}" class="disabled"><strong> 新增角色 </strong></a> &nbsp;
                <a href="{{ route('admin.role.index') }}"><strong> 角色管理 </strong></a> &nbsp;
            </div>
        </div><!--toolBar start-->
        <!-- 表单开始 -->
        <div class="panel default-view">
            <div class="panel-heading">
                <strong>添加角色</strong>
            </div>

            {!! Form::open(['url' => route('admin.role.store'),'method'=>'post','class'=>'form-horizontal']) !!}
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        @include('layouts.errors')
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name','角色英文名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'角色英文名不允许重复']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('display_name','角色中文文名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('display_name',old('display_name'),['class'=>'form-control','placeholder'=>'角色展示中文名']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description',"简要描述",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('description',old('description'),['placeholder'=>'这里填写当前角色的简要描述','class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        {!! Form::submit('保存', array('class' => 'btn btn-primary')) !!}
                        {!! Form::button('返回', ['class' => 'btn btn-default','onclick'=>'javascript:history.back(-1);return false;']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop