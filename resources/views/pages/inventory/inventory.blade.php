@extends('layouts.master')
@section('content')

    <!-- Add New Modal -->
    <div id="addNew-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title">Add New Item</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('/inventory')}}" method="POST" role="form">
                        {{csrf_field()}}

                        <label for="Account" class="control-label mb-10">Account<span class="text-danger">*</span></label>
                        <select class="form-control select2 account-add" name="account_id" style="background:#f2f2f2;" required>
                            <option disabled selected>Select Account</option>
                            @foreach($accounts as $account)
                                <option value="{{$account->id}}">{{$account->accounts_name}}</option>
                            @endforeach

                        </select>

                        <label for="Company" class="control-label mb-10">Company<span class="text-danger">*</span></label>
                        <select class="form-control select2 companyId" name="company_id" style="background:#f2f2f2;" required>
                            <option disabled selected>Select Account</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach

                        </select>

                        <label for="branch" class="control-label mb-10">Branch<span class="text-danger">*</span></label>
                        <select class="form-control select2 branchId" name="branch_id" style="background:#f2f2f2;" required>

                        </select>

                        <div class="form-group">
                            <label for="Item Name" class="control-label mb-10">Item Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control item-name"  name="item_name" style="background:#f2f2f2;" required>
                        </div>
                        <div class="form-group">
                            <label for="Description" class="control-label mb-10">Description<span class="text-danger">*</span></label>
                            <input type="text" class="form-control item-desc"  name="item_desc" style="background:#f2f2f2;" required>
                        </div>
                        <div class="form-group">
                            <label for="Purchase Rate" class="control-label mb-10">Purchase Rate<span class="text-danger">*</span></label>
                            <input type="text" class="form-control purchase-rate"  name="purchase_rate" style="background:#f2f2f2;" required>
                        </div>
                        <div class="form-group">
                            <label for="Sell Rate" class="control-label mb-10">Sell Rate<span class="text-danger">*</span></label>
                            <input type="text" class="form-control sell-rate"  name="sell_rate" style="background:#f2f2f2;" required>
                        </div>
                        <div class="form-group">
                            <label for="Item Name" class="control-label mb-10">Alert Quantity<span class="text-danger">*</span></label>
                            <input type="number" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
                        </div>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success addNew-check">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add New Modal -->

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Inventory</h5>

            <br><br>

            <button class="btn btn-success btn-anim" data-toggle="modal" data-target="#addNew-modal"><strong><i class=" icon-plus "></i><span class="btn-text">ADD NEW</span></strong></button>


        </div>

    </div>


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12 mt-20">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table table-hover display pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Purchase Rate</th>
                            <th>Sell Rate</th>
                            <th>Alrert Qty</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($inventories as $item)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$item->item_name}}</td>
                                <td>{{$item->item_desc}}</td>
                                <td>{{$item->purchase_rate}}</td>
                                <td>{{$item->sell_rate}}</td>
                                <td>{{$item->alert_qty}}</td>
                                <td>
                                    @if($item->status == '1')
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $item->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm "><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="POST" action="inventory/{{ $item->id }}" id="delete">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm" onclick="del();"><i class="fa fa-trash"></i></button>
                                            </form>


                                        </div>
                                    </div>
                                </td>


                            </tr>
                            @php $i++; @endphp

                            {{--edit Modal--}}
                            <div class="modal bs-example-modal-edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Inventory</h5>
                                        </div>
                                        {!! Form::model($item, ['method' => 'PATCH','url' => ['inventory', $item->id],
                                         'files'=>true,'class' => 'inventory_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">

                                                {!! Form::hidden('account_id' , null ,['class' => 'form-control','id' => 'account_id'.$item->id,'required' => 'required'] ) !!}
                                                {!! Form::hidden('company_id' , null ,['class' => 'form-control','id' => 'company_id'.$item->id,'required' => 'required'] ) !!}
                                                {!! Form::hidden('branch_id' , null ,['class' => 'form-control','id' => 'branch_id'.$item->id,'required' => 'required'] ) !!}

                                                <div class="col-sm-12">
                                                    <div class="row p-10">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Item Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('item_name' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Item Name','id' => 'item_name'.$item->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>


                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Description<span class="text-danger">*</span></label>
                                                                {!! Form::text('item_desc' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Item Description','id' => 'item_desc'.$item->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Purchase Rate<span class="text-danger">*</span></label>
                                                                {!! Form::text('purchase_rate' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Item Description','id' => 'purchase_rate'.$item->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Sell Rate<span class="text-danger">*</span></label>
                                                                {!! Form::text('sell_rate' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Item Description','id' => 'sell_rate'.$item->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Alert Quantity<span class="text-danger">*</span></label>
                                                                {!! Form::text('alert_qty' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Item Description','id' => 'alert_qty'.$item->id,'required' => 'required'] ) !!}

                                                            </div>
                                                        </div>


                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                <div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        {!! Form::radio('status', 1,['id' => 'radio1'.$item->id]) !!}
                                                                        <label for="radio1{{ $item->id }}"> Active </label>
                                                                    </div>

                                                                    <div class="radio radio-info radio-inline">
                                                                        {!! Form::radio('status', 0,['id' => 'radio12'.$item->id]) !!}
                                                                        <label for="radio12{{ $item->id }}"> In Active </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

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

    <script type="text/javascript">
        $(document).ready(function(){
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