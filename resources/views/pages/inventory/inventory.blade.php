@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Inventory's Items</h5>
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
                        <h5 class="modal-title" id="myLargeModalLabel">Add Items</h5>
                    </div>
                    <form data-toggle="validator" role="form" method="POST" id="inventory_submit" action="{{route('inventory.store')}}">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-10">
                                    <div class="row p-10">
                                        <div class="col-sm-12" align="left">
                                            <h5>Basic Information</h5>
                                            <hr>
                                        </div>

                                         <input type="hidden" name="company_id" value="{{Auth::user()->company_id}}">

                                        <div class="col-sm-4">
                                            <label for="Account" class="control-label">Account<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="account_id">
                                                <option disabled selected>Select Account</option>
                                                @foreach($accounts as $account)
                                                    <option value="{{$account->id}}">{{$account->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Branch Name<span class="text-danger">*</span></label>
                                                @if(Auth::user()->role_id == 2)
                                                    <select class="form-control select2" name="branch_id">
                                                        @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif(Auth::user()->role_id == 3  )
                                                    <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}">
                                                @endif
                                            </div>
                                        </div>
                                       
                                    {{--Item Information--}}
                                        <div class="col-sm-12" align="left">
                                            <h5>Item Information</h5>
                                            <hr>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Item Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="item_name" required  placeholder="Enter Item Name">
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Item Description<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="item_desc" required  placeholder="Enter Item Description">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Opening Quantity<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control small-input" name="opening_qty" required  placeholder="Enter Opening Quantity">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="" class="control-label">Alert Quantity<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control small-input" name="alert_qty" required  placeholder="Enter Alert Quantity">
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
        <div class="col-sm-12 mt-20">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table table-hover display pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Opening Qty</th>
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
                                <td>{{$item->opening_qty}}</td>
                                <td>{{$item->alert_qty}}</td>
                                <td>
                                    @if($item->status == '1')
                                        <b style="color: green">Active</b>
                                    @else
                                        <b style="color: red">Inactive</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg-edit{{ $item->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm "><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="POST" action="{{ url('inventory/'.$item->id) }}" id="delete{{$item->id}}">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm" onclick="del({{$item->id}});"><i class="fa fa-trash"></i></button>
                                            </form>


                                        </div>
                                    </div>
                                </td>


                            </tr>
                            @php $i++; @endphp

                            {{--edit Modal--}}
                            <div class="modal fade bs-example-modal-lg-edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 95%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Inventory</h5>
                                        </div>
                                        {!! Form::model($item, ['method' => 'PATCH','url' => ['inventory', $item->id],
                                         'files'=>true,'class' => 'inventory_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-10">
                                                    <div class="row p-10">
                                                    {{--Item Information--}}
                                                        <div class="col-sm-12" align="left">
                                                            <h5>Item Information</h5>
                                                            <hr>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Item Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('item_name' , null ,['class' => 'form-control','placeholder' => 'Enter Item Name','id' => 'item_name'.$item->id,'required' => 'required'] ) !!}
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Description<span class="text-danger">*</span></label>
                                                                {!! Form::text('item_desc' , null ,['class' => 'form-control','placeholder' => 'Enter Item Description','id' => 'item_desc'.$item->id,'required' => 'required'] ) !!}
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Opening Quantity<span class="text-danger">*</span></label>
                                                                {!! Form::text('opening_qty' , null ,['class' => 'form-control','placeholder' => 'Opening Quantity','id' => 'opening_qty'.$item->id,'required' => 'required'] ) !!}
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Alert Quantity<span class="text-danger">*</span></label>
                                                                {!! Form::text('alert_qty' , null ,['class' => 'form-control','placeholder' => 'Alert Quantity','id' => 'alert_qty'.$item->id,'required' => 'required'] ) !!}
                                                            </div>
                                                        </div>

                                                         <div class="col-sm-4">
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
                                                <div class="col-sm-1"></div>

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