@extends('layouts.admin')
@section('content')
<div class="col-md-10 col-sm-9">
    <div class="panel row">
        <div class="panel-heading">
            <a href="{{ route('user.create') }}" class="disabled"><strong> 新增用户 </strong></a> &nbsp;
            <a href="{{ route('user.index') }}"><strong> 用户管理 </strong></a> &nbsp;
        </div>
    </div><!--toolBar start-->
    <!-- 表单开始 -->
        <div class="panel default-view">
            <div class="panel-heading">
                <strong>添加用户</strong>
            </div>

            {!! Form::open(['url' => route('user.create'),'method'=>'post','class'=>'form-horizontal']) !!}
                <div class="panel-body">
                    <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        @include('layouts.errors')
                    </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name','用户名',['class'=>'control-label col-md-4']) !!}
                        <div class="col-md-2">
                            {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'用户名不允许重复']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::text('real_name',old('real_name'),['class'=>'form-control','placeholder'=>'昵称不允许重复']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email','邮箱',['class'=>'control-label col-md-4']) !!}
                        <div class="col-md-4">
                            {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>'邮箱不允许重复']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('password','密码',['class'=>'control-label col-md-4']) !!}
                        <div class="col-md-4">
                            {!! Form::password('password', ['placeholder'=>'用户密码在6~18位','class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation',"确认密码",['class'=>'control-label col-md-4']) !!}
                        <div class="col-md-4">
                            {!! Form::password('password_confirmation',['placeholder'=>'确认密码在6~18位,且和上面的密码保持一致','class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('gender',"性别",['class'=>'control-label col-md-4']) !!}
                        <div class="col-md-4">
                            {!! Form::select('gender', ['不填','男','女'], old('gender') , array('class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                        {!! Form::submit('保存', array('class' => 'btn btn-primary')) !!}
                        {!! Form::button('返回', ['class' => 'btn btn-default','click'=>'btn btn-default']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
</div>
@stop