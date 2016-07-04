@if(isset($menuList['child']))
    @foreach($menuList['child'] as $key => $menuChild)

    <nav id="subnav" class="menu leftmenu affix" data-toggle="menu">
        <ul class="nav nav-primary">
            <!-- 子导航 -->
            <li class="nav-parent show"><a href="javascript:;"><span class="icon icon-cube-alt"></span>{{ config('menu.group.' . $key) }}<i class="icon-rotate-90"></i></a>
                <ul class="nav" style="display: block;">
                    @if(is_array($menuChild))
                        @foreach($menuChild as $subMenu)
                            <li class="@if(\Route::currentRouteName() == $subMenu['name']) active @endif">
                                <a href="{{ route($subMenu['name']) }}"><i class="icon-list-ul"></i>{{ $subMenu['display_name'] }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
        </ul>
    </nav>
    @endforeach
@endif