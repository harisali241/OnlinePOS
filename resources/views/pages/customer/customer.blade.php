@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Customers</h5>

            <br><br>

            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success btn-anim">Add Customer</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Customer</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" action="{{route('customer.store')}}">
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
                                                    <select class="form-control select2 companyId" name="company_id">
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
                                                    <select class="form-control select2 branchId" name="branch_id">

                                                    </select>
                                                </div>
                                            </div>

                                            {{-- Branch --}}

                                            {{-- Customer name--}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Customer Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="customer_name" placeholder="Enter Customer Name">
                                                </div>
                                            </div>

                                            {{-- Customer name--}}

                                            {{-- Customer email --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Customer Email<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" required name="customer_email" placeholder="Enter Customer Email">
                                                </div>
                                            </div>

                                            {{-- customer email --}}

                                            {{-- customer phoneNo --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Customer Contact Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="customer_phoneNo" id="customer_phoneNo" placeholder="Enter Phone No">
                                                </div>
                                            </div>

                                            {{-- customer phoneNo --}}

                                            {{-- Customer Address --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Address</label>
                                                    <textarea class="form-control" rows="3" name="customer_address" id="customer_address" placeholder="Enter Address"></textarea>
                                                </div>
                                            </div>

                                            {{-- customer Address --}}

                                            {{-- Credit Limit --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Credit Limit<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="credit_limit" placeholder="Enter Credit Limit">
                                                </div>
                                            </div>

                                            {{-- Credit Limit --}}

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
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone No</th>
                            <th>Customer Address</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($customers as $customer)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->customer_email}}</td>
                                <td>{{$customer->customer_phoneNo}}</td>
                                <td>{{$customer->customer_address}}</td>
                                <td>
                                    @if($customer->status === 1)
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>

                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $customer->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post" action="customer/{{$customer->id}}" id="delete">
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
                            <div class="modal fade bs-example-modal-edit{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Customer</h5>
                                        </div>
                                        {!! Form::model($customer, ['method' => 'PATCH','url' => ['customer', $customer->id],
                                         'files'=>true,'class' => 'customer_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="row p-10">

                                                        {!! Form::hidden('account_id' , null ,['class' => 'form-control','id' => 'account_id'.$customer->id,'required' => 'required'] ) !!}
                                                        {!! Form::hidden('company_id' , null ,['class' => 'form-control','id' => 'company_id'.$customer->id,'required' => 'required'] ) !!}
                                                        {!! Form::hidden('branch_id' , null ,['class' => 'form-control','id' => 'branch_id'.$customer->id,'required' => 'required'] ) !!}


                                                        {{-- Account --}}

                                                        {{--<div class="col-sm-12">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="inputName" class="control-label mb-10">Account<span class="text-danger">*</span></label>--}}
                                                                {{--{!! Form::select('account_id' ,$edit_accounts, null ,['class' => 'form-control select2',--}}
                                                                {{--'id' => 'account_id'.$customer->id] ) !!}--}}

                                                            {{--</div>--}}
                                                        {{--</div>--}}

                                                        {{-- Account --}}

                                                        {{-- Company Name --}}

                                                        {{--<div class="col-sm-12">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="inputName" class="control-label mb-10">Companies<span class="text-danger">*</span></label>--}}
                                                                {{--{!! Form::select('company_id' ,$edit_companies, null ,['class' => 'form-control select2',--}}
                                                                {{--'id' => 'company_id'.$customer->id] ) !!}--}}

                                                            {{--</div>--}}
                                                        {{--</div>--}}

                                                        {{-- Company Name --}}

                                                        {{-- Branch Name --}}

                                                        {{--<div class="col-sm-12">--}}
                                                            {{--<div class="form-group">--}}
                                                                {{--<label for="inputName" class="control-label mb-10">Branches<span class="text-danger">*</span></label>--}}
                                                                {{--{!! Form::select('branch_id' ,$edit_branches, null ,['class' => 'form-control select2',--}}
                                                                {{--'id' => 'branch_id'.$customer->id] ) !!}--}}

                                                            {{--</div>--}}
                                                        {{--</div>--}}

                                                        {{-- Branch Name --}}

                                                        {{-- customer Name --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Customer Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('customer_name' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Customer Name','id' => 'customer_name'.$customer->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- customer Name --}}

                                                        {{-- Customer Email --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Customer Email<span class="text-danger">*</span></label>
                                                                {!! Form::email('customer_email' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Customer Email','id' => 'customer_email'.$customer->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Customer Email --}}

                                                        {{-- Customer phoneno --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Customer Contact No<span class="text-danger">*</span></label>
                                                                {!! Form::text('customer_phoneNo' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Customer Phone No','id' => 'customer_phoneNo'.$customer->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Customer phoneon --}}

                                                        {{-- Customer Address --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Address</label>
                                                                {!! Form::textarea('customer_address' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Address','rows' => '3'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Customer Address --}}

                                                        {{-- Credit Limit --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Credit Limit<span class="text-danger">*</span></label>
                                                                {!! Form::text('credit_limit' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Credit Limit'.$customer->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Credit Limit --}}

                                                        {{-- Status --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                <div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        {!! Form::radio('status', 1,['id' => 'radio1'.$customer->id]) !!}
                                                                        <label for="radio1{{ $customer->id }}"> Active </label>
                                                                    </div>

                                                                    <div class="radio radio-info radio-inline">
                                                                        {!! Form::radio('status', 0,['id' => 'radio12'.$customer->id]) !!}
                                                                        <label for="radio12{{ $customer->id }}"> In Active </label>
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

        $(document).ready(function (e) {
            $('.branchId').attr('disabled', 'disabled');

            $(".companyId").on('change', function () {
                $('.branchId').text('');
                var id = $(this).val();

                $.ajax({
                    url:'/reqBranches',
                    method:'POST',
                    dataType:'JSON',
                    data:{ 'id' : id , '_token': '{{csrf_token()}}' },
                    success: function (data) {

                        $('.branchId').removeAttr('disabled');

                        $('.branchId').append('<option disabled selected>Select Branch</option>');

                        data.forEach(function (result) {
                            $('.branchId').append('<option value="'+result.id+'">'+result.branch_name+'</option>');
                            //console.log(result.branch_name);
                        })

                    },
                });
            });
        });

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