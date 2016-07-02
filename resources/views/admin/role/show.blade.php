@extends('layouts.admin')
@section('script')
<script>
    +function($){
        var permissionArray = {{ $thisPermissionArray }};
        if(permissionArray){
            $('.permission').each(function(){
                if( $.inArray( parseInt(this.value),permissionArray ) > -1 ){
                    $(this).prop('checked',true);
                }
            });
        }

        $('.permission_all').on('change',function(){
            $(this).closest('.panel').find('.panel-body').find('input[type=checkbox]').prop('checked',this.checked);
        });
        $('.permission_row').on('change',function(){
            $(this).closest('.rule_check').find('.child_row').find('input').prop('checked',this.checked);
        });
    }(jQuery);
</script>
@stop
@section('content')
<div class="col-md-10 col-sm-9">
    <div class="panel row">
        <div class="panel-heading">
            <a href="http://localhost:8000/admin/user" class="disabled"><strong> 用户管理 </strong></a> &nbsp;
            <a href="http://localhost:8000/admin/user/create" class=""><strong> 新增用户</strong></a> &nbsp;
        </div>
    </div>

    @if(empty($permissions))
        @include('layouts.empty',['info'=>"抱歉！暂不存在任何权限，请添加权限。"])
    @else
        <form class="form-inline" action="{{ route('admin.role.editPersissionToRole',$role->id) }}" method="post" id="permissionsList">
            {{ csrf_field() }}
            @foreach($permissions as $tree)
            <div class="panel-group">
                <div class="panel row">
                    <div class="panel-heading">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="permission_id[]" class="permission permission_all" value="{{ $tree['id'] }}" data-permission-url="{{ $tree['name'] }}" />
                            <strong>{{ $tree['display_name'] }}</strong>
                        </label>
                    </div>
                    @if(isset($tree['_child']))
                        @foreach($tree['_child'] as $tree2)
                        <div class="panel-body">
                            <div class="rule_check">
                                <div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="permission_id[]" class="permission permission_row" value="{{ $tree2['id'] }}" data-permission-url="{{ $tree2['name'] }}" />
                                        {{ $tree2['display_name'] }}
                                    </label>
                                </div>
                                <span class="divsion">&nbsp;</span>
                                <span class="child_row">
                                    @if(isset($tree2['_child']))
                                        @foreach($tree2['_child'] as $tree3)
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="permission_id[]" class="permission" value="{{ $tree3['id'] }}" data-permission-url="{{ $tree3['name'] }}" />
                                            {{ $tree3['display_name'] }}
                                        </label>
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @endforeach
            <div class="panel row">
                <div class="panel-footer text-center">
                    <input type="submit" class="btn btn-primary ajax-post" target-form="accessForm" value="保存"> <input type="button" value="返回" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                </div>
            </div>
        </form>
    @endif
</div>
@stop