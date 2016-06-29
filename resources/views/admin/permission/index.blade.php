@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{ asset('static/admin/css/category.css') }}" />
@stop
@section('script')
<script type="text/javascript">
    (function($){
        /* 分类展开收起 */
        //  $(".category dd").prev().find(".fold i").addClass("icon-unfold")
        $(".category dd").prev().find(".fold i").addClass("icon-unfold")
                .click(function(){
                    var self = $(this);
                    if(self.hasClass("icon-unfold")){
                        self.closest("dt").next().slideUp("fast", function(){
                            self.removeClass("icon-unfold").addClass("icon-fold");
                        });
                    } else {
                        self.closest("dt").next().slideDown("fast", function(){
                            self.removeClass("icon-fold").addClass("icon-unfold");
                        });
                    }
                });

        /* 三级分类删除新增按钮 */
        $(".category dd dd .add-sub").remove();

        /* 实时更新分类信息 */
        $(".category")
                .on("submit", "form", function(){
                    var self = $(this);
                    $.post(
                            self.attr("action"),
                            self.serialize(),
                            function(data){
                                /* 提示信息 */
                                var name = data.status ? "success" : "error", msg;

                                $.zui.messager.show(data.info,{type:name}); // 提示信息

                                /*msg = self.find(".msg").addClass(name).text(data.info)
                                 .css("display", "inline-block");
                                 setTimeout(function(){
                                 msg.fadeOut(function(){
                                 msg.text("").removeClass(name);
                                 });
                                 }, 1000);*/
                            },
                            "json"
                    );
                    return false;
                })
                .on("focus","input",function(){
                    $(this).data('param',$(this).closest("form").serialize());

                })
                .on("blur", "input", function(){
                    if($(this).data('param')!=$(this).closest("form").serialize()){
                        $(this).closest("form").submit();
                    }
                });
    })(jQuery);
</script>
@stop
@section('content')
<div class="col-md-10 col-sm-9">
    <div class="panel">
        <div class="panel-heading">
            <a href="{{ route('permission.create') }}" ><span class="icon icon-plus icon-plus-sign"></span> <strong>添加权限</strong></a>
        </div>
    </div><!--toolBar start-->
    <!-- 列表开始 -->
    <link rel="stylesheet" href="css/category.css">
    <div class="panel" id="panel-list">
        <div class="panel-heading">
            <strong>权限管理</strong> <span class="pull-right">共 <strong>2</strong> 记录</span>
        </div>
        <div class="category">
            <div class="hd clearfix">
                <div class="fold">
                    折叠
                </div>
                <div class="order" data-toggle="tooltip" title="数值越小越靠前">
                    排序
                </div>
                <div class="name">
                    名称
                </div>
                <div class="do pull-right">
                    操作
                </div>
            </div>
            <dl class="cate-item">
                <dt class="clearfix">
                    <form action="http://blog.webfsd.com/backend.php/AuthManager/editAuthRule.html" method="post">
                        <div class="btn-toolbar opt-btn clearfix">
                            <a href="http://blog.webfsd.com/backend.php/AuthManager/editAuthRule/id/75/pid/1.html" data-toggle="modal">编辑</a>
                            <a href="http://blog.webfsd.com/backend.php/AuthManager/changeAuthRuleStatus/status/delete/ids/75/model/AuthRule.html" class="deleter">删除</a>
                        </div>

                        <div class="fold"><i></i></div>
                        <div class="order"><input type="text" name="sort" class="form-control text input-mini" value="11"></div>
                        <div class="name">
                            <span class="tab-sign"></span>
                            <input type="hidden" name="id" value="75">
                            <input type="text" name="title" class="form-control text" style="width: 200px;display: inline-block" value="保存页面表单配置">
                            <a class="add-sub-cate" data-toggle="tooltip" title="添加子分类" href="http://blog.webfsd.com/backend.php/AuthManager/addAuthRule/pid/75.html"><i class="icon-plus"></i></a>
                        </div>
                    </form>
                </dt>
                <dd> {{--二级菜单--}}
                    <dl class="cate-item">
                        <dt class="clearfix">
                            <form action="/backend.php/AuthManager/editAuthRule.html" method="post">
                                <div class="btn-toolbar opt-btn clearfix">
                                    <a href="/backend.php/AuthManager/editAuthRule/id/75/pid/1.html" data-toggle="modal">编辑</a>
                                    <a href="/backend.php/AuthManager/changeAuthRuleStatus/status/delete/ids/75/model/AuthRule.html" class="deleter">删除</a>
                                </div>
                                <div class="fold"><i></i></div>
                                <div class="order"><input type="text" name="sort" class="form-control text input-mini" value="11"></div>
                                <div class="name">
                                    <span class="tab-sign"></span>
                                    <input type="hidden" name="id" value="75">
                                    <input type="text" name="title" class="form-control text" style="width: 200px;display: inline-block" value="保存页面表单配置">
                                    <a class="add-sub-cate" data-toggle="tooltip" title="添加子分类" href="/backend.php/AuthManager/addAuthRule/pid/75.html"><i class="icon-plus"></i></a>
                                </div>
                            </form>
                        </dt>
                    </dl>
                    <dl class="cate-item">
                        <dt class="clearfix">
                        <form action="/backend.php/AuthManager/editAuthRule.html" method="post">
                            <div class="btn-toolbar opt-btn clearfix">
                                <a href="/backend.php/AuthManager/editAuthRule/id/76/pid/1.html" data-toggle="modal">编辑</a>
                                <a href="/backend.php/AuthManager/changeAuthRuleStatus/status/delete/ids/76/model/AuthRule.html" class="deleter">删除</a>
                            </div>
                            <div class="fold"><i></i></div>
                            <div class="order"><input type="text" name="sort" class="form-control text input-mini" value="12"></div>
                            <div class="name">
                                <span class="tab-sign"></span>
                                <input type="hidden" name="id" value="76">
                                <input type="text" name="title" class="form-control text" style="width: 200px;display: inline-block" value="保存页面搜索配置">
                                <a class="add-sub-cate" data-toggle="tooltip" title="添加子分类" href="/backend.php/AuthManager/addAuthRule/pid/76.html"><i class="icon-plus"></i></a>
                            </div>
                        </form>
                        </dt>
                    </dl>
                </dd>
            </dl>
        </div>
    </div>
</div>


@stop