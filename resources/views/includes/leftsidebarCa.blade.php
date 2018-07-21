Left Sidebar Menu -->
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
            <a href="{{url('terminal')}}"><div class="pull-left"><i class="fa fa-shopping-basket  mr-20"></i><span class="right-nav-text">Terminal</span></div><div class="pull-right"></div><div class="clearfix"></div></a>

        </li>


        <li class="navigation-header">
            <span>locals</span>
            <i class="zmdi zmdi-more"></i>
        </li>

        {{--<li>
            <a href="{{url('nature')}}"><div class="pull-left"><i class=" icon-badge  mr-20"></i><span class="right-nav-text">Natures</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
        </li>
--}}
        <li>
            <a href="{{url('account')}}"><div class="pull-left"><i class=" icon-fire  mr-20"></i><span class="right-nav-text">Accounts</span></div><div class="pull-right"></div><div class="clearfix"></div></a>
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
        {{-- <li>
            <a href="{{url('/purchase/create')}}"><div class="pull-left"><i class=" icon-key mr-20"></i><span class="right-nav-text">Purchase</span></div><div class="pull-right"><span class="label label-warning"></span></div><div class="clearfix"></div></a>
        </li> --}}
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pages_dr"><div class="pull-left"><i class=" icon-key mr-20"></i><span class="right-nav-text">Purchase Order</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="pages_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="{{url('/purchase/create')}}">Create Purchase Order</a>
                </li>
                <li>
                    <a href="{{url('/purchase')}}">Pending PO</a>
                </li>
                <li>
                    <a href="{{url('/purchaseapprove')}}">Approve PO</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pages_grn"><div class="pull-left"><i class=" icon-note mr-20"></i><span class="right-nav-text">Good Receive Note</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="pages_grn" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="{{url('/grn/create')}}">Create GRN</a>
                </li>
                <li>
                    <a href="{{url('/grn')}}">View Pending GRN</a>
                </li>
                <li>
                    <a href="{{url('/grnComplete')}}">View Completed GRN</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pages_dr1"><div class="pull-left"><i class=" icon-key mr-20"></i><span class="right-nav-text">Sale Order</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="pages_dr1" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="{{url('/sale/create')}}">Create Sale Order</a>
                </li>
                <li>
                    <a href="{{url('/sale')}}">View Sale Orders</a>
                </li>
            </ul>
        </li>

    </ul>

</div>
<!-- /Left Sidebar Menu