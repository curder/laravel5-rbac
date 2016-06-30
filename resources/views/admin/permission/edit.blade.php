@extends('layouts.admin')
@section('content')
    <div class="col-md-10 col-sm-9">
        <div class="panel row">
            <div class="panel-heading">
                <a href="{{ route('permission.edit',$permission->id) }}" class="disabled"><strong> 编辑权限 </strong></a> &nbsp;
                <a href="{{ route('permission.index') }}"><strong> 权限管理 </strong></a> &nbsp;
            </div>
        </div><!--toolBar start-->
        <!-- 表单开始 -->
        <div class="panel default-view">
            <div class="panel-heading">
                <strong>编辑权限</strong>
            </div>

            {!! Form::open(['url' => route('permission.create'),'method'=>'post','class'=>'form-horizontal']) !!}
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        @include('layouts.errors')
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name','权限英文名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name',$permission->name,['class'=>'form-control','placeholder'=>'权限英文名不允许重复']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('display_name','权限中文文名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('display_name',$permission->display_name,['class'=>'form-control','placeholder'=>'权限展示中文名']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description',"简要描述",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('description',$permission->description,['placeholder'=>'这里填写当前权限的简要描述','class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('parent_id',"上级权限",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::select('parent_id', $permissionsTree, $permission->parent_id , ['class' => 'form-control','placeholder'=>'请选择上级权限']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('is_menu',"是否是菜单",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::radio('is_menu',0,true,['class'=>'']) !!} 不是
                        {!! Form::radio('is_menu',1,false,['class'=>'']) !!} 是
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