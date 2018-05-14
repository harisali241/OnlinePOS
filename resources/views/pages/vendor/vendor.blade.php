@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Vendors</h5>

            <br><br>

            <form class="form-inline" style="position:absolute; top:60%; left:25%; transform:translateX(-50%);">
                <input type="hidden" value="fadeInLeftBig" id="entrance">
                <input type="hidden" value="flipOutX" id="exit">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-anim" data-toggle="modal" data-target="#createvendor">
                    <strong>
                        <i class=" icon-plus "></i>
                        <span class="btn-text">ADD NEW</span>
                    </strong>
                </button>
            </form>

            <!-- Add Modal -->
            <div class="modal fade" id="createvendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Vendor</h4>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" action="{{ route('vender.store') }}">

                            {{csrf_field()}}

                            <div class="modal-body">

                                <!-- Account ID -->

                                    <div class="form-group">

                                        <div class="form-group{{ $errors->has('account_id') ? ' has-error' : '' }}">



                                            <label for="account_id">Account</label>
                                            <select class="form-control select2" name="account_id" style="background:#f2f2f2;" required>
                                                <option disabled selected>Select Account</option>

                                                @foreach($accounts as $account)
                                                    <option value="{{$account->id}}">{{$account->accounts_name}}</option>
                                                @endforeach

                                            </select>

                                            @if ($errors->has('account_id'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('account_id') }}</strong>
                                                </span>
                                            @endif



                                        </div>

                                    </div>

                                <!-- Account ID -->

                                <!-- Company ID -->

                                    <div class="form-group">

                                        <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">



                                            <label for="account_id">Company</label>
                                            <select class="form-control select2" name="company_id" style="background:#f2f2f2;" required>
                                                <option disabled selected>Select Company</option>

                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                @endforeach

                                            </select>

                                            @if ($errors->has('account_id'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('account_id') }}</strong>
                                                </span>
                                            @endif



                                        </div>

                                    </div>

                                <!-- Company ID -->

                                <!-- Branch ID -->

                                <div class="form-group">

                                    <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">


                                        <label for="branch_id">Branch</label>
                                        <select class="form-control select2" name="branch_id" style="background:#f2f2f2;" required>
                                            <option disabled selected>Select Branch</option>

                                            @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                            @endforeach

                                        </select>

                                        @if ($errors->has('branch_id'))
                                            <span class="help-block">
                                                            <strong>{{ $errors->first('branch_id') }}</strong>
                                                </span>
                                        @endif

                                    </div>

                                </div>

                                <!-- Branch ID -->

                                <!-- Vendor Name -->

                                    <div class="form-group">

                                        <div class="form-group{{ $errors->has('vendor_name') ? ' has-error' : '' }}">
                                            <label for="vendor_name" class="control-label mb-10">Vendor Name</label>
                                            <input type="text" class="form-control" required name="vendor_name" style="background:#FFF;" placeholder="Enter Name">
                                            @if ($errors->has('vendor_name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('vendor_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                <!-- Vendor Name -->

                                <!-- Vendor Email -->

                                    <div class="form-group">

                                        <div class="form-group{{ $errors->has('vendor_email') ? ' has-error' : '' }}">
                                            <label for="vendor_email" class="control-label mb-10">Vendor Email</label>
                                            <input type="text" class="form-control" name="vendor_email" style="background:#FFF;" required placeholder="Enter Email">
                                            @if ($errors->has('vendor_email'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('vendor_email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                <!-- Vendor Email -->

                                <!-- Vendor Phone Number -->

                                    <div class="form-group">

                                        <div class="form-group{{ $errors->has('vendor_phoneNo') ? ' has-error' : '' }}">
                                            <label for="vendor_phoneNo" class="control-label mb-10">Vendor Phone Number</label>
                                            <input type="text" class="form-control" name="vendor_phoneNo" style="background:#FFF;" required placeholder="Enter Phone Number">
                                            @if ($errors->has('vendor_phoneNo'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('vendor_phoneNo') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                <!-- Vendor Phone Number -->

                                <!-- Vendor Address -->

                                    <div class="form-group">

                                        <div class="form-group{{ $errors->has('vendor_address') ? ' has-error' : '' }}">
                                            <label for="vendor_address" class="control-label mb-10">Vendor Address</label>
                                            <textarea class="form-control" name="vendor_address" value="{{ old('vendor_address') }}" id="textarea" rows="3" maxlength="200" placeholder="Enter Vendor Address Here"></textarea>
                                            @if ($errors->has('vendor_address'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('vendor_address') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                <!-- Vendor Address -->

                                <!-- Status -->

                                    <div class="form-group">

                                        <label class="control-label mb-10">Status</label>
                                        <div>
                                            <input id="check_box_switch" name="status" type="checkbox" data-off-text="Inactive" data-on-text="Active"  class="bs-switch" />
                                        </div>
                                    </div>

                                <!-- Status -->

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- Add MOdal -->


        </div>

    </div>


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12 mt-20">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table table-hover display  pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Vendor Name</th>
                            <th>Address</th>
                            <th>Account Name</th>
                            <th>Status</th>
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($vendors as $vendor)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$vendor->vendor_name}}</td>
                                <td>{{$vendor->vendor_address}}</td>
                                <td>{{$vendor->account->accounts_name}}</td>
                                <td>
                                    @if($vendor->status == '1')
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="row">
                                        <div style="width:50px;float:left;">

                                            <form style="position:relative; top:50%; left:60%; transform:translateX(-50%);">
                                                <input type="hidden" value="rollIn" id="editentrance">
                                                <input type="hidden" value="rollOut" id="editexit">
                                                <!-- Button trigger modal -->

                                                <button type="button" class="btn btn-warning btn-icon-anim btn-square" data-toggle="modal" data-target="#editvendor{{$vendor->id}}">

                                                    <i class="fa fa-pencil"></i>

                                                </button>

                                            </form>


                                        </div>

                                        <div style="width:50px;float:left;">


                                            <form style="position:relative; top:50%; left:60%; transform:translateX(-50%);">
                                                <input type="hidden" value="fadeInLeftBig" id="showentrance">
                                                <input type="hidden" value="fadeOutRightBig" id="showexit">
                                                <!-- Button trigger modal -->

                                                <button type="button" class="btn btn-dropbox btn-icon-anim btn-square" data-toggle="modal" data-target="#viewvendor{{$vendor->id}}">

                                                    <i class="fa fa-eye"></i>

                                                </button>

                                            </form>

                                        </div>

                                        <div style="width:50px;float:left;">
                                            <form method="post" action="vender/{{$vendor->id}}" id="delete">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square" onclick="del();"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp

                            <!-- Edit Modal -->

                            <div class="modal fade editvendor" id="editvendor{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                <div class="modal-dialog" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Edit Vendor</h4>
                                        </div>

                                        <!-- Form For Update -->

                                            <form data-toggle="validator" role="form" method="POST" action="{{ url('vender/'.$vendor->id) }}">

                                                {{csrf_field()}}
                                                {{ method_field('PATCH') }}

                                                <!-- Modal Body -->

                                                    <div class="modal-body">

                                                        <!-- Account ID -->

                                                            <div class="form-group">
                                                                <div class="form-group{{ $errors->has('account_id') ? ' has-error' : '' }}">
                                                                    <label for="account_id">Account Name</label>
                                                                    <select class="form-control select2" name="account_id" style="background:#f2f2f2;" required>
                                                                        <option value="{{$vendor->account_id}}">{{$vendor->account->accounts_name}}</option>
                                                                        <option disabled>-------------------</option>
                                                                        @foreach($accounts as $account)
                                                                            <option value="{{$account->id}}">{{$account->accounts_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('account_id'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('account_id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        <!-- Account ID -->

                                                        <!-- Company ID -->

                                                            <div class="form-group">
                                                                <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">
                                                                    <label for="company_id">Company Name</label>
                                                                    <select class="form-control select2" name="company_id" style="background:#f2f2f2;" required>
                                                                        <option value="{{$vendor->company_id}}">{{$vendor->company->company_name}}</option>
                                                                        <option disabled>-------------------</option>
                                                                        @foreach($companies as $company)
                                                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('company_id'))
                                                                        <span class="help-block">
                                                                            <strong>{{ $errors->first('company_id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        <!-- Company ID -->

                                                        <!-- Branch ID -->

                                                        <div class="form-group">
                                                            <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">
                                                                <label for="branch_id">Branch Name</label>
                                                                <select class="form-control select2" name="branch_id" style="background:#f2f2f2;" required>
                                                                    <option value="{{$vendor->branch_id}}">{{$vendor->branch->branch_name}}</option>
                                                                    <option disabled>-------------------</option>
                                                                    @foreach($branches as $branch)
                                                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('branch_id'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('branch_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- Branch ID -->

                                                        <!-- Vendor Name -->

                                                        <div class="form-group">

                                                            <div class="form-group{{ $errors->has('vendor_name') ? ' has-error' : '' }}">
                                                                <label for="vendor_name" class="control-label mb-10">Vendor Name</label>
                                                                <input type="text" class="form-control" required name="vendor_name" style="background:#FFF;" placeholder="Enter Name" value="{{$vendor->vendor_name}}">
                                                                @if ($errors->has('vendor_name'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('vendor_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        <!-- Vendor Name -->

                                                        <!-- Vendor Email -->

                                                        <div class="form-group">

                                                            <div class="form-group{{ $errors->has('vendor_email') ? ' has-error' : '' }}">
                                                                <label for="vendor_email" class="control-label mb-10">Vendor Email</label>
                                                                <input type="text" class="form-control" name="vendor_email" style="background:#FFF;" required placeholder="Enter Email" value="{{$vendor->vendor_email}}">
                                                                @if ($errors->has('vendor_email'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('vendor_email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        <!-- Vendor Email -->

                                                        <!-- Vendor Phone Number -->

                                                        <div class="form-group">

                                                            <div class="form-group{{ $errors->has('vendor_phoneNo') ? ' has-error' : '' }}">
                                                                <label for="vendor_phoneNo" class="control-label mb-10">Vendor Phone Number</label>
                                                                <input type="text" class="form-control" name="vendor_phoneNo" style="background:#FFF;" required placeholder="Enter Phone Number" value="{{$vendor->vendor_phoneNo}}">
                                                                @if ($errors->has('vendor_phoneNo'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('vendor_phoneNo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        <!-- Vendor Phone Number -->

                                                        <!-- Vendor Address -->

                                                        <div class="form-group">

                                                            <div class="form-group{{ $errors->has('vendor_address') ? ' has-error' : '' }}">
                                                                <label for="vendor_address" class="control-label mb-10">Vendor Address</label>
                                                                <textarea class="form-control" name="vendor_address" value="{{ old('vendor_address') }}" id="textarea" rows="3" maxlength="200" placeholder="Enter Vendor Address Here">{{ $vendor->vendor_address }}</textarea>
                                                                @if ($errors->has('vendor_address'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('vendor_address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        <!-- Vendor Address -->

                                                        <!-- Status -->

                                                        <div class="form-group">

                                                            <label class="control-label mb-10">Status</label>
                                                            <div>
                                                                <input id="check_box_switch" name="status" type="checkbox" data-off-text="Inactive" data-on-text="Active" data-toggle="Inactive" class="bs-switch @php if($vendor->status == 0){ echo'switch'; } @endphp"/>
                                                            </div>

                                                        </div>

                                                        <!-- Status -->

                                                    </div>

                                                <!-- Modal Body -->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>

                                            </form>

                                        <!-- Form For Update -->
                                    </div>

                                </div>

                            </div>

                            <!-- Edit Modal -->

                            <!-- View Modal -->

                            <div class="modal fade showvendor" id="viewvendor{{$vendor->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

                                <div class="modal-dialog" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Show Vendor</h4>
                                        </div>

                                        <div class="modal-body">

                                            <!-- Account ID -->

                                                <div class="row" style="border-bottom: 2px solid gray;">

                                                    <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                        <div class="form-control text-center" style="background:#FFF; border: none;">
                                                            <span style="text-transform: capitalize;">Account Name</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                        <div class="form-control text-center" style="background:#FFF; border: none;">
                                                            <span style="text-transform: capitalize;">{{$vendor->account->accounts_name}}</span>
                                                        </div>
                                                    </div>

                                                </div>

                                            <!-- Account ID -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Company ID -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Comapny Name</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">{{$vendor->company->company_name}}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Comapny ID -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Branch ID -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Branch Name</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">{{$vendor->branch->branch_name}}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Branch ID -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Vendor Name -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Vendor Name</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">{{$vendor->vendor_name}}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Vendor Name -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Vendor Email -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Vendor Email</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">{{$vendor->vendor_email}}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Vendor Email -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Vendor Phone No -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Vendor Phone Number</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">{{$vendor->vendor_phoneNo}}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Vendor Phone No -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Vendor Address -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Vendor Address</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">{{$vendor->vendor_address}}</span>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Vendor Address -->

                                            <div class="clearfix" style="margin-top: 10px;"></div>

                                            <!-- Vendor Status -->

                                            <div class="row" style="border-bottom: 2px solid gray;">

                                                <div class="col-md-6" style="border-right: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        <span style="text-transform: capitalize;">Vendor Status</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="border-left: 2px dashed #000;">
                                                    <div class="form-control text-center" style="background:#FFF; border: none;">
                                                        @if($vendor->status == '1')
                                                            <span style="text-transform: capitalize; color: red;">Active</span>
                                                        @else
                                                            <span style="text-transform: capitalize; color: grey;">Inactive</span>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Vendor Status -->

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- View Modal -->

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

        function del(){
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f8b32d",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function(){

                swal("Deleted!", "Your record has been deleted.", "success");
                $("#delete").submit();

            });
            return false;
        }

    </script>

    <script type="text/javascript">

        $(document).ready(function (e) {
            $('.switch').click();
        })

    </script>

@endsection