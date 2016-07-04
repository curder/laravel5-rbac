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
                @if(isset($menuList['main']))
                @foreach($menuList['main'] as $mainMenu)
                    <li class="@if(isset($mainMenu['class'])) active @endif">
                        <a href="{{ (count(explode('.',$mainMenu['name'])) == 2) ? route($mainMenu['name'] . '.index') : route($mainMenu['name']) }}">
                            {{ $mainMenu['display_name'] }}
                        </a>
                    </li>
                @endforeach
                @endif
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
        {{--左侧菜单--}}
        @section('nav')
            @include('admin.layouts.nav')
        @show

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
@if(!empty($onload))
    <script type="text/javascript">
        $(document).ready(function(){
            @foreach($onload as $v) {!! $v !!}; @endforeach
        });
    </script>
@endif
@yield('script')
</body>
</html>