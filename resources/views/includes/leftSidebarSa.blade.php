Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    @php //createAdminPermission() @endphp
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="{{url('/')}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>


        <li>
            <a href="{{url('company')}}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Tenants/Companies</span></div><div class="pull-right"></div><div class="clearfix"></div></a>

        </li>

    </ul>

</div>
<!-- /Left Sidebar Menu