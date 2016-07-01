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
                <a href="{{ route('permission.edit',$permission->id) }}" class="disabled"><strong> 编辑权限 </strong></a> &nbsp;
                <a href="{{ route('permission.index') }}"><strong> 权限管理 </strong></a> &nbsp;
            </div>
        </div><!--toolBar start-->
        <!-- 表单开始 -->
        <div class="panel default-view">
            <div class="panel-heading">
                <strong>编辑权限</strong>
            </div>

            {!! Form::open(['url' => route('permission.edit',$permission->id),'method'=>'post','class'=>'form-horizontal']) !!}
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
                        <select name="parent_id" id="parent_id" class="form-control" placeholder="请选择上级权限分类">
                            <option value="">请选择上级分类</option>
                            @foreach($permissionsTree as $key => $tree)
                                <option value="{{ $key }}"
                                        @if($key == $permission->parent_id) selected @endif
                                        @if(in_array($key,$disabledIdsArr))) disabled @endif
                                >{{ $tree }}</option>
                            @endforeach
                        </select>
                        {{--{!! Form::select('parent_id', $permissionsTree, $permission->parent_id , ['class' => 'form-control','placeholder'=>'请选择上级权限','multiple']) !!}--}}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('is_menu',"是否是菜单",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::radio('is_menu',0,$permission->is_menu == 0 ? true :false,['class'=>'']) !!} 不是
                        {!! Form::radio('is_menu',1,$permission->is_menu == 1 ? true : false,['class'=>'']) !!} 是
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        {!! Form::submit('保存', array('class' => 'btn btn-primary')) !!}
                        {!! Form::button('返回', ['class' => 'btn btn-default','click'=>'javascript:history.back(-1);return false;']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop