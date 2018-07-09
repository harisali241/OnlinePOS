@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Companies & Tenant</h5>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">

            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
            class="btn btn-success btn-anim">Create +</button>


        </div>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="width: 95%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title" id="myLargeModalLabel">Add Company & Tenant</h5>
                    </div>
                    <form data-toggle="validator" role="form" method="POST" id="company_submit" action="{{route('company.store')}}">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-10">
                                    <div class="row p-10">
                                        <div class="col-sm-12" align="left">
                                            <h5>Admin Information</h5>
                                            <hr>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">First Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="firstName" required  placeholder="Enter First Name">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="lastName" required placeholder="Enter Last Name">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Phone No</label>
                                                <input type="number" class="form-control small-input" name="phoneNo"  placeholder="Enter Phone No" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Email<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control small-input" name="email" required placeholder="Enter Email Address">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Username<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input username" name="username" autocomplete="off" required placeholder="Enter Username">
                                                <span class="username_check"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Password<span class="text-danger">*</span></label>
                                                <input type="text" name="email-fake" style="display: none">
                                                <input type="password" name="password-fake" style="display: none">
                                                <input type="password" class="form-control small-input" autocomplete="off" name="password" required placeholder="Enter Password">
                                            </div>
                                        </div>


                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="" class="control-label">Address</label>
                                                <textarea class="form-control " rows="3" name="address" id="company_address" placeholder="Enter Address"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                <div>
                                                    <div class="radio radio-success radio-inline">
                                                        <input type="radio" name="status" id="radio1" value="1" checked>
                                                        <label for="radio1"> Active </label>
                                                    </div>

                                                    <div class="radio radio-info radio-inline">
                                                        <input type="radio" name="status" id="radio2" value="0">
                                                        <label for="radio2"> In Active </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--USer Information End--}}

                                        {{--Company Information--}}
                                        <div class="col-sm-12" align="left">

                                            <h5>Company Information</h5>
                                            <hr>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="" class="control-label">Company Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="company_name" required  placeholder="Enter Company Name">
                                            </div>
                                        </div>


                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="" class="control-label">Company Location<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="location" id="location" required  placeholder="Enter Company Location">
                                                (Please Add Location On Google Map First)
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="" class="control-label">latitude</label>
                                                <input type="text" class="form-control small-input" name="latitude" id="latitude" required readonly placeholder="Latitude">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="" class="control-label">longitude</label>
                                                <input type="text" class="form-control small-input" name="longitude" id="longitude" required readonly placeholder="latitude">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-default btn-sm" style="margin-top: 20px;" id="show_map1">Show Map</button>
                                        </div>
                                        <div class="col-sm-12" id="create_map">

                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-1"></div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default text-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success text-left submit_form_check">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="col-sm-12">
            <hr>
        </div>


    </div>


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table table-hover display pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Admin Name</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$user->firstName}} {{$user->lastName}}</td>
                                <td>{{$user->companies->company_name}}</td>
                                <td>{{$user->companies->location}}</td>
                                <td>{{$user->username}}</td>
                                <td>
                                    @if($user->status == 1)
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>

                                    <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $user->id }}"
                                            class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5" style="float: left;margin-right: 2%"><i class="fa fa-pencil"></i></button>


                                    <form method="post" action="{{ url('company/'.$user->companies->id) }}" id="delete{{$user->companies->id}}">
                                        {{csrf_field()}}
                                        {{method_field("DELETE")}}

                                        <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" style="float: left;margin-right: 2%" onclick="del({{$user->companies->id}});"><i class="fa fa-trash"></i></button>
                                    </form>


                                </td>
                            </tr>
                            @php $i++; @endphp
                            {{--edit Modal--}}
                            <div class="modal bs-example-modal-edit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 95%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Company</h5>
                                        </div>
                                        {!! Form::model($user, ['method' => 'PATCH','url' => ['company', $user->company_id],
                                         'files'=>true,'class' => 'company_add_submit_edit','role' => 'form' ]) !!}
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-10">
                                                        <div class="row p-10">
                                                            <div class="col-sm-12" align="left">
                                                                <h5>Admin Information</h5>
                                                                <hr>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">First Name<span class="text-danger">*</span></label>
                                                                    {!! Form::text('firstName' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter First Name','required'] ) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Last Name<span class="text-danger">*</span></label>
                                                                    {!! Form::text('lastName' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter Last Name','required'] ) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Phone No</label>
                                                                    {!! Form::number('phoneNo' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter Phone No','oninput' => 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);', 'maxlength' => '11'] ) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Email<span class="text-danger">*</span></label>
                                                                    {!! Form::email('email' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter Email','required'] ) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Username<span class="text-danger">*</span></label>
                                                                    {!! Form::text('username' , null ,['class' => 'form-control small-input username2',
                                                                    'placeholder' => 'Enter Username','required','data-userId' => $user->id] ) !!}

                                                                    <span class="username_check{{$user->id}}"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Password</label>
                                                                    <input type="email" name="email-fake" style="display: none">
                                                                    <input type="password" name="password-fake" style="display: none">
                                                                    <input type="password" class="form-control small-input" autocomplete="false" name="password" id="password{{$user->id}}" readonly placeholder="Change Password If Needed">
                                                                    <a href="javascript:void(0);" class="change_pass" data-userId="{{ $user->id }}" style="float: right;">Change Password</a>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Address</label>
                                                                    {!! Form::textarea('address' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Address','rows' => '3'] ) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                    <div>

                                                                        <div class="radio radio-info radio-inline">
                                                                            {!! Form::radio('status', 1,['id' => 'inlineRadio14'.$user->id]) !!}
                                                                            <label for="inlineRadio14{{$user->id}}"> Active </label>
                                                                        </div>
                                                                        <div class="radio radio-pink radio-inline">
                                                                            {!! Form::radio('status', 0,['id' => 'inlineRadio15'.$user->id]) !!}
                                                                            <label for="inlineRadio15{{$user->id}}"> In Active </label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            {{--USer Information End--}}

                                                            {{--Company Information--}}
                                                            <div class="col-sm-12" align="left">

                                                                <h5>Company Information</h5>
                                                                <hr>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Company Name<span class="text-danger">*</span></label>
                                                                    {!! Form::text('companies[company_name]' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter Company Name','required'] ) !!}

                                                                </div>
                                                            </div>


                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Company Location<span class="text-danger">*</span></label>

                                                                    {!! Form::text('companies[location]' , null ,['class' => 'form-control small-input location2',
                                                                    'placeholder' => 'Enter Company location','required','data-userId' => $user->id] ) !!}

                                                                    (Please Add Location On Google Map First)
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">latitude</label>
                                                                    {!! Form::text('companies[latitude]' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Latitude','required','readonly','id' => 'latitude'.$user->id ,'data-userId' => $user->id] ) !!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">longitude</label>
                                                                    {!! Form::text('companies[longitude]' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'longitude','required','readonly','id' => 'longitude'.$user->id ,'data-userId' => $user->id] ) !!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <button type="button" class="btn btn-default btn-sm show_map2" style="margin-top: 20px;" data-userId="{{$user->id}}">Show Map</button>
                                                            </div>
                                                            <div class="col-sm-12" id="create_map{{$user->id}}">

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"></div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default text-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success text-left submit_form_check{{$user->id}}">Submit</button>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            {{--edit Modal--}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->


@endsection

@section('script')

    <script>

        function del(company_id){

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Company & Admin!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "red",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function(){

                swal("Deleted!", "Your record has been deleted.", "success");
                $("#delete"+company_id).submit();

            });
            return false;
        }

    </script>

@endsection