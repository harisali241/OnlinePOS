@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Add New User</h5>

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
    <form data-toggle="validator" role="form" method="POST" action="{{route('users.store')}}">
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
                                                <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Last Name</label>
                                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
                                            </div>



                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Password</label>
                                                <input type="password" name="fake-password" style="visibility: hidden;position: absolute; left: 5000000px;">
                                                <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password" required>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Email</label>
                                                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                            </div>

                                            @if(auth()->user()->role_id*1 === 2)
                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Branch</label>
                                                <select name="branch_id" class="form-control select2 branch_id">
                                                    <option value="" selected>Select Branches</option>
                                                    <option value="">No Branch</option>
                                                    @foreach($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
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

                                                </select>
                                            </div>

                                            <div class="col-sm-6 form-group">
                                                <label for="" class="control-label">Phone No</label>
                                                <input type="number" class="form-control" name="phoneNo" placeholder="Phone No" required>
                                            </div>

                                            <div class="col-sm-12 form-group">
                                                <label for="" class="control-label">Address</label>
                                                <textarea name="address" placeholder="Address" class="form-control" rows="3"></textarea>
                                            </div>

                                            <div class="col-sm-12 form-group">
                                                <label for="" class="control-label">Status</label>
                                                <div>
                                                    <div class="radio radio-primary radio-inline">
                                                        {!! Form::radio('status', 1,['id' => 'inlineRadio14']) !!}
                                                        <label for="inlineRadio14"> Active </label>
                                                    </div>
                                                    <div class="radio radio-primary radio-inline">
                                                        {!! Form::radio('status', 0,['id' => 'inlineRadio15']) !!}
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
                                    
                                    {{-- new Row add karlo yaha nechy wali copy kar k dosri parent klie --}}

                                    <div class="row">
                                        <div class="col-xs-12 parent-box">
                                            <span>Branches</span>
                                            <input type="checkbox" class="checkb parent-checkbox">
                                        </div>

                                        <div class="col-xs-12 child-box">
                                            <span>Create Branch</span>
                                            <input type="checkbox" class="checkb child-checkbox">
                                        </div>
                                        <div class="col-xs-12 child-box">
                                            <span>View Branch</span>
                                            <input type="checkbox" class="checkb child-checkbox">
                                        </div>
                                        <div class="col-xs-12 child-box">
                                            <span>Edit Branch</span>
                                            <input type="checkbox" class="checkb child-checkbox">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 parent-box">
                                            <span>Vendors</span>
                                            <input type="checkbox" class="checkb parent-checkbox">
                                        </div>

                                        <div class="col-xs-12 child-box">
                                            <span>Create Vendor</span>
                                            <input type="checkbox" class="checkb child-checkbox">
                                        </div>
                                        <div class="col-xs-12 child-box">
                                            <span>View Vendors</span>
                                            <input type="checkbox" class="checkb child-checkbox">
                                        </div>
                                        <div class="col-xs-12 child-box">
                                            <span>Edit Vendor</span>
                                            <input type="checkbox" class="checkb child-checkbox">
                                        </div>
                                    </div>

                                    {{-- new Row add karlo yaha uper wali copy kar k dosri parent klie --}}

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

            $('.parent-box').on('click', function(){
               
                if($(this).parent().find('.child-box').is(":visible")){
                    $(this).parent().find('.child-box').fadeOut(300);
                }else{
                    $(this).parent().find('.child-box').fadeIn(300);
                }
            });
            $('.parent-checkbox').on('change', function(){
                if($(this).is(':checked') == true){
                    $(this).parent().parent().find('.child-box').find('.child-checkbox').prop('checked', true);
                }else{
                    $(this).parent().parent().find('.child-box').find('.child-checkbox').prop('checked', false);
                }
            });


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