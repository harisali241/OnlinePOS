<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Short Key</h5>
            </div>
            <div class="modal-body">
                <h5 class="mb-15">Overflowing text to show scroll behavior</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title">Today Sale</h5>
            </div>
            <div class="modal-body">
                <h5 class="mb-15">Overflowing text to show scroll behavior</h5>
                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<header style="background-color: #575a60 !important;">
    
        <div class="logo-wrap" style="width: 120px; float: left; background-color: whitesmoke"> 
            <a href="{{url('/')}}">
                <span class="brand-text" style="color: #000;font-weight: bold;">Online<strong style="color:#337f27;">&nbsp;POS</strong></span>
            </a>
        </div>

        <div class="nav-icons">
            <div class="icons dropdown auth-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span style="color:white;">{{ Auth::user()->username }}</span><span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
                    </li>
                    <li>
                        <a href="inbox.html"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                    </li>
                    <li class="divider"></li>
                    <li class="sub-menu show-on-hover">
                        <a href="#" class="dropdown-toggle pr-0 level-2-drp"><i class="zmdi zmdi-check text-success"></i> available</a>
                        <ul class="dropdown-menu open-left-side">
                            <li>
                                <a href="#"><i class="zmdi zmdi-check text-success"></i><span>available</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-circle-o text-warning"></i><span>busy</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="zmdi zmdi-minus-circle-outline text-danger"></i><span>offline</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <form id="logoutForm" method="post" action="{{ route('logout') }}">
                            {{csrf_field()}}
                            <button class="btn btn primary" type="submit" form="logoutForm" style="background:#4aa23c;width: 100%;text-align: center;color: #ffffff;font-weight: bolder"><span>Log Out</span></button>
                        </form>
                    </li>
                </ul>
            </div>
            
            <div class="icons" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Display">
                <a class="ti-desktop" ></a>
            </div>

            <div class="icons" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Keys">
                <a class="ti-key" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
            </div>

            <div class="icons" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Dashbord">
                <a href="{{url("/")}}"  class="ti-dashboard"></a>
            </div>
            
            <div class="icons">
                <div style=""><b>{{date('D d \of M Y')}}</b></div>
            </div>
        </div>

        
</header>

        