<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="{{url('/')}}"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="{{url('company')}}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Companies</span></div><div class="pull-right"></div><div class="clearfix"></div></a>

        </li>

        <li>
            <a href="{{url('branch')}}"><div class="pull-left"><i class="fa fa-fort-awesome mr-20"></i><span class="right-nav-text">Branches</span></div><div class="pull-right"></div><div class="clearfix"></div></a>

        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#terminal_dr"><div class="pull-left"><i class="fa fa-shopping-basket mr-20"></i><span class="right-nav-text">Terminals</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="terminal_dr" class="collapse collapse-level-1">
                <li>
                    <a href="{{url('terminal/create')}}">Add New Terminal</a>
                </li>
                <li>
                    <a href="{{url('terminal')}}">View Terminals</a>
                </li>.
            </ul>
        </li>
        <li>


        <li class="navigation-header">
            <span>locals</span>
            <i class="zmdi zmdi-more"></i>
        </li>

        <li>
            <a href="{{url('nature')}}"><div class="pull-left"><i class="fa fa-fort-awesome mr-20"></i><span class="right-nav-text">Natures</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>

        <li>
            <a href="{{url('account')}}"><div class="pull-left"><i class="fa fa-fort-awesome mr-20"></i><span class="right-nav-text">Accounts</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>

        <li>
            <a href="{{url('vender')}}"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Vendors</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>

        <li>
            <a href="{{url('customer')}}"><div class="pull-left"><i class="icon-credit-card  mr-20"></i><span class="right-nav-text">Customers</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>

        <li class="navigation-header">
            <span>Store</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="{{url('/inventory')}}"><div class="pull-left"><i class=" icon-basket-loaded  mr-20"></i><span class="right-nav-text">Inventory</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li>
    </ul>

</div>
<!-- /Left Sidebar Menu -->