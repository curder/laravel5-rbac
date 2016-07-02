<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello world!</title>
    <!-- zui -->
    {!! Html::style('static/admin/zui/css/zui.css') !!}
    {{--{!! Html::style('//cdn.bootcss.com/chosen/1.5.0/chosen.min.css') !!}--}}
    {!! Html::style('static/admin/zui/lib/chosen/chosen.min.css') !!}
    {!! Html::style('static/admin/css/public.css') !!}
    @yield('style')
</head>
<body>
<header id="header">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="mainNavbar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-div">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:;">后台管理中心</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-div">
            <ul class="nav navbar-nav">
                <li class=""><a href="/backend.php/Index/index.html"><span class="icon-dashboard"></span>&nbsp;&nbsp;<b>首页</b></a></li>
                <li class=""><a href="/backend.php/Article/index.html"><span class="icon-rss-sign"></span>&nbsp;&nbsp;<b>内容</b></a></li>
                <li class="active"><a href="{{ route('admin.user.index') }}"><span class="icon-user"></span>&nbsp;&nbsp;<b>用户</b></a></li>
                <li class=""><a href="/backend.php/Config/group.html"><span class="icon-cog"></span>&nbsp;&nbsp;<b>系统</b></a></li>
                <li class=""><a href="/backend.php/Addons/index.html"><span class="icon-info-sign"></span>&nbsp;&nbsp;<b>其他</b></a></li>
                {{--<li class="dropdown">--}}
                  {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">列表 <b class="caret"></b></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li><a href="commlist.html">普通列表</a></li>--}}
                        {{--<li><a href="treelist.html">树形列表</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/" target="_blank"><i class="icon icon-home"></i> 前台</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">你好，curder <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/backend.php/User/updatePassword.html" data-toggle="modal">修改密码</a></li>
                        <li><a href="/backend.php/User/updateUserName.html" data-toggle="modal">修改昵称</a></li>
                        <li class="divider"></li>
                        <li><a onclick="admin.logout()" href="javascript:;">退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="row-main">
    <div class="col-md-2 col-sm-3">
        <nav id="subnav" class="menu leftmenu affix" data-toggle="menu">
            <ul class="nav nav-primary">
                <!-- 子导航 -->
                <li class="nav-parent show"><a href="javascript:;"><span class="icon icon-cube-alt"></span>用户管理<i class="icon-rotate-90"></i></a>
                    <ul class="nav" style="display: block;">
                        <li class="active"><a href="{{ route('admin.user.index') }}"><i class="icon-list-ul"></i>用户管理</a></li>
                        <li><a href="{{ route('admin.role.index') }}"><i class="icon-play"></i>角色管理</a></li>
                        <li><a href="{{ route('admin.permission.index') }}"><i class="icon-list-ul"></i>权限列表</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    @yield('content')
</div>
<!-- jQuery (ZUI中的Javascript组件依赖于jQuery) -->
{{--{!! Html::script('//cdn.bootcss.com/jquery/1.11.0/jquery.min.js') !!}--}}
{!! Html::script('static/admin/js/jquery.min.js') !!}
<!-- ZUI Javascript组件 -->
{!! Html::script('static/admin/zui/js/zui.min.js') !!}
{{--{!! Html::script('//cdn.bootcss.com/chosen/1.5.0/chosen.jquery.min.js') !!}--}}
{!! Html::script('static/admin/zui/lib/chosen/chosen.min.js') !!}
{!! Html::script('static/admin/js/admin.js') !!}
@yield('script')
</body>
</html>