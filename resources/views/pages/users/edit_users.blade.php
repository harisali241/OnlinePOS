@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Edit User</h5>

        </div>
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">
            <a href="{{ url('users') }}"
               class="btn btn-success btn-anim">Users List</a>
        </div>

        <div class="col-sm-12">
            <hr>
        </div>

    </div>


    <!-- Row -->
    <form data-toggle="validator" role="form" method="POST" action="{{url('users/'.$user->id)}}">
        <input type="hidden" name="_method" value="PATCH">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-7">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">User Information</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-wrap">


                                        <div class="row" style="margin: 0;">
                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">First Name</label>
                                                <input type="text" class="form-control" value="{{ $user->firstName }}" name="firstName" placeholder="First Name" required>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Last Name</label>
                                                <input type="text" class="form-control" value="{{ $user->lastName }}"  name="lastName" placeholder="Last Name" required>
                                            </div>



                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Username</label>
                                                <input type="text" class="form-control" value="{{ $user->username }}"  name="username" placeholder="Username" required>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Password</label>
                                                <input type="password" name="fake-password" style="visibility: hidden;position: absolute; left: 5000000px;">
                                                <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Change Password If Needed">
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"  placeholder="Email Address" required>
                                            </div>

                                            @if(auth()->user()->role_id*1 === 2)
                                                <div class="col-sm-6 form-group">
                                                    <label for="" class="control-label">Branch</label>
                                                    <select name="branch_id" class="form-control select2 branch_id">
                                                        <option value="" selected>Select Branches</option>
                                                        <option value="">No Branch</option>
                                                        @foreach($branches as $branch)
                                                            @if($branch->id === $user->branch_id)
                                                                <option value="{{ $branch->id }}" selected>{{ $branch->branch_name }}</option>
                                                            @else
                                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
                                            @endif

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Terminal</label>
                                                <select name="terminal_id" class="form-control select2 terminal_id">
                                                    <option value="" selected>Select Terminal</option>
                                                    @if(count($terminals) > 0)
                                                        @foreach($terminals as $terminal)
                                                            @if($terminal->id === $user->terminal_id)
                                                                <option value="{{ $terminal->id }}" selected>{{ $terminal->terminal_name }}</option>
                                                            @else
                                                                <option value="{{ $terminal->id }}">{{ $terminal->terminal_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Phone No</label>
                                                <input type="number" class="form-control" value="{{ $user->phoneNo }}" name="phoneNo" placeholder="Phone No" required>
                                            </div>

                                            <div class="col-sm-12 form-group">
                                                <label for="" class="control-label">Address</label>
                                                <textarea name="address"  placeholder="Address" class="form-control" rows="3">{{ $user->address }}</textarea>
                                            </div>

                                            <div class="col-sm-12 form-group">
                                                <label for="" class="control-label">Status</label>
                                                <div>
                                                    <div class="radio radio-primary radio-inline">
                                                        {!! Form::radio('status', 1,($user->status === 1) ? true:false,['id' => 'inlineRadio14']) !!}
                                                        <label for="inlineRadio14"> Active </label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        {!! Form::radio('status', 0,($user->status === 0) ? true:false,['id' => 'inlineRadio15']) !!}
                                                        <label for="inlineRadio15"> In Active </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Permissions</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-wrap">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <hr>
            </div>
            <div class="col-sm-12" align="right">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ url('users') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
    <!-- /Row -->

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('.branch_id').change(function () {
                var branch_id = $(this).val();

                if(branch_id !== '')
                {
                    $.ajax({
                        url:'/get_terminals',
                        method:'GET',
                        dataType:'JSON',
                        data:{ branch_id : branch_id },
                        success: function (response) {
                            var html = '<option value="" selected>Select Terminal</option><option value="">No Terminal</option>';

                            response.forEach(function (data) {
                                html+= '<option value="'+data.id+'">'+data.terminal_name+'</option>'
                            });
                            $('.terminal_id').html(html);
                        }
                    });
                }
                else{
                    var html = '<option value="" selected>Select Terminal</option><option value="">No Terminal</option>';
                    $('.terminal_id').html(html);
                }
            });
        });
    </script>
@endsection