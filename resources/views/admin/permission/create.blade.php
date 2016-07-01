@extends('layouts.admin')
@section('script')
<script>
    $(function(){
        $("#parent_id").chosen({
            allow_single_deselect:true
            ,no_results_text: '没有匹配的选项'
            , placeholder_text:' '           // 当检索时没有找到匹配项时显示的提示文本
            , disable_search_threshold: 2   // 5个以下的选择项则不显示检索框
            , width: '100%'
            , search_contains: true         // 从任意位置开始检索
            ,display_disabled_options:true  // 显示不可选的选项
        });
    })
</script>
@stop
@section('content')
    <div class="col-md-10 col-sm-9">
        <div class="panel row">
            <div class="panel-heading">
                <a href="{{ route('admin.permission.create') }}" class="disabled"><strong> 新增权限 </strong></a> &nbsp;
                <a href="{{ route('admin.permission.index') }}"><strong> 权限管理 </strong></a> &nbsp;
            </div>
        </div><!--toolBar start-->
        <!-- 表单开始 -->
        <div class="panel default-view">
            <div class="panel-heading">
                <strong>添加权限</strong>
            </div>

            {!! Form::open(['url' => route('admin.permission.store'),'method'=>'post','class'=>'form-horizontal']) !!}
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        @include('layouts.errors')
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name','权限英文名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'权限英文名不允许重复']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('display_name','权限中文文名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('display_name',old('display_name'),['class'=>'form-control','placeholder'=>'权限展示中文名']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description',"简要描述",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::textarea('description',old('description'),['placeholder'=>'这里填写当前权限的简要描述','class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('parent_id',"上级权限",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        <select name="parent_id" id="parent_id" class="form-control" placeholder="请选择上级权限分类">
                            <option value="">请选择上级分类</option>
                            @foreach($permissionsTree as $key => $tree)
                                <option value="{{ $key }}"
                                        @if($key == $id) selected @endif
                                >{{ $tree }}</option>
                            @endforeach
                        </select>
                        {{--{!! Form::select('parent_id', $permissions, old('parent_id') , ['class' => 'form-control','placeholder'=>'请选择上级权限']) !!}--}}
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
                        {!! Form::button('返回', ['class' => 'btn btn-default','onclick'=>'javascript:history.back(-1);return false;']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop