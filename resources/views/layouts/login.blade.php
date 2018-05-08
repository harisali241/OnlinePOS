<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>onlinePOS</title>
    <meta name="description" content="online point of sell" />
    <meta name="keywords" content="company, branches, selling, stores, shopmart, buy, onlinePOS, software" />
    <meta name="author" content="hencework"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="{{ asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>



    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<div class="wrapper pa-0">
    <header class="sp-header">
        <div class="sp-logo-wrap pull-left">
            <a href="">
                {{--<img class="brand-img mr-10" src="dist/img/logo.png" alt="brand"/>--}}
                <span class="brand-text">onlinePOS</span>
            </a>
        </div>
        {{--<div class="form-group mb-0 pull-right">--}}
            {{--<span class="inline-block pr-10">Don't have an account?</span>--}}
            {{--<a class="inline-block btn btn-info  btn-rounded btn-outline" href="signup.html">Sign Up</a>--}}
        {{--</div>--}}
        <div class="clearfix"></div>
    </header>

    <!-- Main Content -->
    <div class="page-wrapper pa-0 ma-0 auth-page">
        <div class="container-fluid">
            <!-- Row -->
            <div class="table-struct full-width full-height">
                <div class="table-cell vertical-align-middle auth-form-wrap">
                    <div class="auth-form  ml-auto mr-auto no-float">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="mb-30">
                                    <h3 class="text-center txt-dark mb-10">Login</h3>
                                </div>
                                <div class="form-wrap">

                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                            <label class="control-label mb-10" for="email"><b>Username</b></label>
                                            <input type="text" name="username" class="form-control" autofocus required value="{{ old('username') }}" id="email" placeholder="Enter Username">

                                                @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('username') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                            <label class="pull-left control-label mb-10" for="password">Password</label>
                                            <input type="password" name="password" class="form-control" required id="password" placeholder="Enter password">

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                        </div>


                                        <div class="form-group">
                                            <div class="checkbox checkbox-primary pr-10 pull-left">
                                                <input id="checkbox_2" type="checkbox">
                                                <label for="checkbox_2"> Keep me logged in</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-danger  btn-rounded">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

<!-- Init JavaScript -->
<script src="{{ asset('dist/js/init.js') }}"></script>
</body>
</html>
