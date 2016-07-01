@extends('layouts.admin')
@section('script')
    <script>
        $(function(){
            $("#id").chosen({
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
                <a href="{{ route('admin.user.getGroup',$user->id) }}" class="disabled">用户 <strong>{{ $user->name }}</strong> 添加到组</a> &nbsp;
                <a href="{{ route('admin.user.index') }}"><strong> 用户管理 </strong></a> &nbsp;
            </div>
        </div><!--toolBar start-->
        <!-- 表单开始 -->
        <div class="panel default-view">
            <div class="panel-heading">
                <strong>授权用户 - {{ $user->name }} 到组</strong> <small>完事用户就拥有该组的相关权限</small>
            </div>

            {!! Form::open(['url' => route('admin.user.postGroup',$user->id),'method'=>'post','class'=>'form-horizontal']) !!}
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        @include('layouts.errors')
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name','用户名',['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        {!! Form::text('name',$user->name,['class'=>'form-control','disabled'=>true]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('parent_id',"所属角色",['class'=>'control-label col-md-4']) !!}
                    <div class="col-md-4">
                        <select name="id[]" id="id" class="form-control" placeholder="请选择所属角色" multiple>
                            <option value="">请选择所属角色</option>
                            @foreach($allRole as $role)
                                <option @if(in_array($role->id,$this_roles))selected = "selected"@endif value="{{ $role->id }}">
                                    {{ $role->display_name }}({{ $role->name }})
                                </option>
                            @endforeach
                        </select>
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