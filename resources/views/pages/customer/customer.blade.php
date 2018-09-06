@extends('layouts.master')
@section('content')


        <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Customers</h5>
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
                            <h5 class="modal-title" id="myLargeModalLabel">Add Customer</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" action="{{route('customer.store')}}">
                            {{csrf_field()}}

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-1"></div>

                                    <div class="col-sm-10">
                                        <div class="row p-10">

                                            <input type="hidden" value="{{ Auth::user()->company_id }}" name="company_id">
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                                            {{-- Branch --}}

                                            @if(auth()->user()->role_id === 2)
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                                                        <select class="form-control select2 branch_id" name="branch_id" id="branch_id">
                                                            <option disabled selected value="0">Select Branch Name</option>
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                            @elseif(auth()->user()->role_id === 3)
                                                <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
                                            @endif

                                            {{-- Branch --}}

                                            {{-- account --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Account Name<span class="text-danger">*</span></label>
                                                    <select class="form-control select2 account_id" name="account_id">
                                                        <option disabled selected value="0">Select Account</option>


                                                    </select>
                                                </div>
                                            </div>

                                            {{-- account --}}

                                            {{-- Status --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="" class="control-label mb-10">Status<span class="text-danger">*</span></label>
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

                                            <div class="col-sm-12"></div>

                                            {{-- vendor name--}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Customer Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control small-input" required name="customer_name" placeholder="Enter Customer Name">
                                                </div>
                                            </div>

                                            {{-- vendor name--}}

                                            {{-- vendor email --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Customer Email<span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control small-input" required name="customer_email" placeholder="Enter Customer Email">
                                                </div>
                                            </div>

                                            {{-- vendor email --}}

                                            {{-- vendor phoneNo --}}

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Customer Contact Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control small-input" required name="customer_phoneNo" id="customer_phoneNo" placeholder="Enter Phone No" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" onkeypress='validate(event)'>
                                                </div>
                                            </div>

                                            {{-- vendor phoneNo --}}

                                            {{-- Vendor Address --}}

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="" class="control-label mb-10">Address</label>
                                                    <input type="text" class="form-control small-input" name="customer_address" placeholder="Enter Address">
                                                </div>
                                            </div>

                                            {{-- Vendor Address --}}

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

            <div class="col-sm-12">
                <hr>
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
                                        <b style="color: green">Active</b>
                                    @else
                                        <b style="color: red">Inactive</b>
                                    @endif
                                </td>
                                <td>

                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $customer->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post" action="{{ url('customer/'.$customer->id) }}" id="delete{{$customer->id}}">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del({{$customer->id}});"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @php $i++; @endphp

                            {{-- Edit Modal --}}
                            <div class="modal fade bs-example-modal-edit{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 95%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Vendor</h5>
                                        </div>
                                        {!! Form::model($customer, ['method' => 'PATCH','url' => ['customer', $customer->id],
                                         'files'=>true,'class' => 'customer_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-10">
                                                    <div class="row p-10">

                                                        {!! Form::hidden('user_id' , $customer->user_id ,['class' => 'form-control','id' => 'user_id'.$customer->id,'required' => 'required'] ) !!}
                                                        {!! Form::hidden('company_id' , $customer->company_id ,['class' => 'form-control','id' => 'company_id'.$customer->id,'required' => 'required'] ) !!}

                                                        {{-- Branch --}}

                                                        @if(auth()->user()->role_id === 2)
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                                                                    {!! Form::select('branch_id',$edit_branches,$customer->branch_id,
                                                                    ['class' => 'select2 form-control branch_id2','data-customerid' => $customer->id  ]) !!}
                                                                </div>
                                                            </div>
                                                        @elseif(auth()->user()->role_id === 3)
                                                            <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
                                                        @endif

                                                        {{-- Branch --}}

                                                        {{-- account --}}

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Account Name<span class="text-danger">*</span></label>
                                                                {!! Form::select('account_id',getAccountOfBranches($customer->branch_id),$customer->account_id,
                                                                ['class' => 'select2 form-control account_id'.$customer->id]) !!}
                                                            </div>
                                                        </div>

                                                        {{-- account --}}

                                                        {{-- Status --}}

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                <div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        {!! Form::radio('status', 1,($customer->status === 1) ? true:false,['id' => 'radio1'.$customer->id]) !!}
                                                                        <label for="radio1{{ $customer->id }}"> Active </label>
                                                                    </div>

                                                                    <div class="radio radio-info radio-inline">
                                                                        {!! Form::radio('status', 0,($customer->status === 0) ? true:false,['id' => 'radio12'.$customer->id]) !!}
                                                                        <label for="radio12{{ $customer->id }}"> In Active </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Status --}}

                                                        <div class="col-sm-12"></div>

                                                        {{-- Vendor Name --}}

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Customer Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('customer_name' , $customer->customer_name ,['class' => 'form-control small-input',
                                                                'placeholder' => 'Enter Customer Name','id' => 'customer_name'.$customer->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor Name --}}

                                                        {{-- Vendor Email --}}

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Customer Email<span class="text-danger">*</span></label>
                                                                {!! Form::email('customer_email' , $customer->customer_email ,['class' => 'form-control small-input',
                                                                'placeholder' => 'Enter Customer Email','id' => 'customer_email'.$customer->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor Email --}}

                                                        {{-- Vendor phoneno --}}

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Customer Contact No<span class="text-danger">*</span></label>
                                                                {!! Form::text('customer_phoneNo' , $customer->customer_phoneNo ,['class' => 'form-control small-input',
                                                                'placeholder' => 'Enter Customer Phone No','id' => 'customer_phoneNo'.$customer->id,'required' => 'required','onkeypress' => 'validate(event)'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor phoneon --}}

                                                        {{-- Vendor Address --}}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Address</label>
                                                                {!! Form::text('customer_address' , $customer->customer_address ,['class' => 'form-control small-input',
                                                                'placeholder' => 'Enter Address'] ) !!}

                                                            </div>
                                                        </div>

                                                        {{-- Vendor Address --}}

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

            $('.branch_id').change(function () {
                var branch_id = $(this).val();

                if(branch_id !== '')
                {
                    $.ajax({
                        url:'/get_accounts',
                        method:'GET',
                        dataType:'JSON',
                        data:{ branch_id : branch_id },
                        success: function (response) {
                            var html = '<option value="" selected>Select Account</option>';

                            response.forEach(function (data) {
                                html+= '<option value="'+data.id+'">'+data.account_name+' ('+data.account_number+')</option>'
                            });
                            $('.account_id').html(html);
                        }
                    });
                }
                else{
                    var html = '<option value="" selected>Select Account</option>';
                    $('.account_id').html(html);
                }
            });

            $('.branch_id2').change(function () {
                var branch_id = $(this).val();
                var id = $(this).data('customerid');

                if(branch_id !== '')
                {
                    $.ajax({
                        url:'/get_accounts',
                        method:'GET',
                        dataType:'JSON',
                        data:{ branch_id : branch_id },
                        success: function (response) {
                            var html = '<option value="" selected>Select Account</option>';

                            response.forEach(function (data) {
                                html+= '<option value="'+data.id+'">'+data.account_name+' ('+data.account_number+')</option>'
                            });
                            $('.account_id'+id).html(html);
                        }
                    });
                }
                else{
                    var html = '<option value="" selected>Select Account</option>';
                    $('.account_id'+id).html(html);
                }
            });
        });

        function del(id){
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
                $("#delete"+id).submit();

            });
            return false;
        }

    </script>

@endsection