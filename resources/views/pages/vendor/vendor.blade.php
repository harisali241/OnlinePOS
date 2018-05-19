@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Vendors</h5>

            <br><br>

            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success btn-anim">Add Vendor</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Vendor</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" action="{{route('vender.store')}}">
                            {{csrf_field()}}

                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="row p-10">

                                            {{-- account --}}

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Account Name<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="account_id">
                                                            <option disabled selected value="0">Select Account</option>
                                                            @foreach($accounts as $account)
                                                                <option value="{{$account->id}}">{{$account->accounts_name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            {{-- account --}}

                                            {{-- Company --}}

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Companies<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="company_id">
                                                            <option disabled selected value="0">Select Company</option>
                                                            @foreach($companies as $company)
                                                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            {{-- Company --}}

                                            {{-- Branch --}}

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Branches<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="branch_id">
                                                            <option disabled selected value="0">Select Branch</option>
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            {{-- Branch --}}

                                            {{-- vendor name--}}

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Vendor Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" required name="vendor_name" placeholder="Enter Vendor Name">
                                                    </div>
                                                </div>

                                            {{-- vendor name--}}

                                            {{-- vendor email --}}

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Vendor Email<span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" required name="vendor_email" placeholder="Enter Vendor Email">
                                                    </div>
                                                </div>

                                            {{-- vendor email --}}

                                            {{-- vendor phoneNo --}}

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Vendor Contact Number<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" required name="vendor_phoneNo" id="vendor_phoneNo" placeholder="Enter Phone No">
                                                    </div>
                                                </div>

                                            {{-- vendor phoneNo --}}

                                            {{-- Vendor Address --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Address</label>
                                                    <textarea class="form-control" rows="3" name="vendor_address" id="vendor_address" placeholder="Enter Address"></textarea>
                                                </div>
                                            </div>

                                            {{-- Vendor Address --}}

                                            {{-- Status --}}

                                                <div class="col-sm-12">
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

                                            {{-- Status --}}

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default text-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success text-left">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


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
                            <th>Vendor Email</th>
                            <th>Vendor Phone No</th>
                            <th>Vendor Address</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($vendors as $vendor)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$vendor->vendor_name}}</td>
                                <td>{{$vendor->vendor_email}}</td>
                                <td>{{$vendor->vendor_phoneNo}}</td>
                                <td>{{$vendor->vendor_address}}</td>
                                <td>
                                    @if($vendor->status === 1)
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>

                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $vendor->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post" action="vender/{{$vendor->id}}" id="delete">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del();"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @php $i++; @endphp

                            {{-- Edit Modal --}}
                            <div class="modal fade bs-example-modal-edit{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Vendor</h5>
                                        </div>
                                        {!! Form::model($vendor, ['method' => 'PATCH','url' => ['vender', $vendor->id],
                                         'files'=>true,'class' => 'vendor_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="row p-10">

                                                        {{-- Account --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Account<span class="text-danger">*</span></label>
                                                                {!! Form::select('account_id' ,$edit_accounts, null ,['class' => 'form-control select2',
                                                                'id' => 'account_id'.$vendor->id] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Account --}}

                                                        {{-- Company Name --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Companies<span class="text-danger">*</span></label>
                                                                {!! Form::select('company_id' ,$edit_companies, null ,['class' => 'form-control select2',
                                                                'id' => 'company_id'.$vendor->id] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Company Name --}}

                                                        {{-- Branch Name --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Branches<span class="text-danger">*</span></label>
                                                                {!! Form::select('branch_id' ,$edit_branches, null ,['class' => 'form-control select2',
                                                                'id' => 'branch_id'.$account->id] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Branch Name --}}

                                                        {{-- Vendor Name --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Vendor Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('vendor_name' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Vendor Name','id' => 'vendor_name'.$vendor->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor Name --}}

                                                        {{-- Vendor Email --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Vendor Name<span class="text-danger">*</span></label>
                                                                {!! Form::email('vendor_email' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Vendor Email','id' => 'vendor_email'.$vendor->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor Email --}}

                                                        {{-- Vendor phoneno --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Vendor Contact No<span class="text-danger">*</span></label>
                                                                {!! Form::text('vendor_phoneNo' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Vendor Phone No','id' => 'vendor_phoneNo'.$vendor->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor phoneon --}}

                                                        {{-- Vendor Address --}}

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Address</label>
                                                                    {!! Form::textarea('vendor_address' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Address','rows' => '3'] ) !!}

                                                                </div>
                                                            </div>

                                                        {{-- Vendor Address --}}

                                                        {{-- Status --}}

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-success radio-inline">
                                                                            {!! Form::radio('status', 1,['id' => 'radio1'.$vendor->id]) !!}
                                                                            <label for="radio1{{ $vendor->id }}"> Active </label>
                                                                        </div>

                                                                        <div class="radio radio-info radio-inline">
                                                                            {!! Form::radio('status', 0,['id' => 'radio12'.$vendor->id]) !!}
                                                                            <label for="radio12{{ $vendor->id }}"> In Active </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        {{-- Status --}}

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default text-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success text-left">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            {{-- Edit Modal --}}
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
                confirmButtonColor: "red",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function(){

                swal("Deleted!", "Your record has been deleted.", "success");
                $("#delete").submit();

            });
            return false;
        }

    </script>

@endsection