Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">

        @foreach(parent_menu() as $parent)

            <li>
                <a href="{{ (child_menu($parent->menu_id)['is_child']) ? '#' : url('/'.$parent->menus->menu_slug) }}" @if(child_menu($parent->menu_id)['is_child']) data-toggle="collapse" data-target="#my_menu{{$parent->menu_id }}"@endif ><div class="pull-left"><i class="{{ $parent->menus->icon }} mr-20"></i><span class="right-nav-text">{{ $parent->menus->menu_name }}</span></div><div class="pull-right">@if(child_menu($parent->menu_id)['is_child'])<i class="zmdi zmdi-caret-down"></i>@endif</div><div class="clearfix"></div></a>

                @if(child_menu($parent->menu_id)['is_child'])

                    <ul id="my_menu{{$parent->menu_id }}" class="collapse collapse-level-1 two-col-list">

                        @foreach(child_menu($parent->menu_id)['data'] as $child)

                            <li>
                                <a href="{{ url('/'.$child->menus->menu_slug) }}">{{ $child->menus->menu_name }}</a>

                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach


    </ul>

</div>
<!-- /Left Sidebar Menu