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

                        <label for="Account" class="control-label mb-10">Account</label>
                        <select class="form-control select2 account-add" name="account_id" style="background:#f2f2f2;">
                            <option disabled selected>Select Account</option>
                            @foreach($accounts as $account)
                                <option value="{{$account->id}}">{{$account->accounts_name}}</option>
                            @endforeach

                        </select>

                        <label for="Company" class="control-label mb-10">Company</label>
                        <select class="form-control select2 companyId" name="company_id" style="background:#f2f2f2;">
                            <option disabled selected>Select Account</option>
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                            @endforeach

                        </select>

                        <label for="branch" class="control-label mb-10">Branch</label>
                        <select class="form-control select2 branchId" name="branch_id" style="background:#f2f2f2;">

                        </select>

                        <div class="form-group">
                            <label for="Item Name" class="control-label mb-10">Item Name</label>
                            <input type="text" class="form-control item-name"  name="item_name" style="background:#f2f2f2;">
                        </div>
                        <div class="form-group">
                            <label for="Description" class="control-label mb-10">Description</label>
                            <input type="text" class="form-control item-desc"  name="item_desc" style="background:#f2f2f2;">
                        </div>
                        <div class="form-group">
                            <label for="Purchase Rate" class="control-label mb-10">Purchase Rate</label>
                            <input type="text" class="form-control purchase-rate"  name="purchase_rate" style="background:#f2f2f2;">
                        </div>
                        <div class="form-group">
                            <label for="Sell Rate" class="control-label mb-10">Sell Rate</label>
                            <input type="text" class="form-control sell-rate"  name="sell_rate" style="background:#f2f2f2;">
                        </div>
                        <div class="form-group">
                            <label for="Item Name" class="control-label mb-10">Alert Quantity</label>
                            <input type="number" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;">
                        </div>
                        <div class="form-group">

                            <label class="control-label mb-10">Status</label>
                            <div>
                                <input id="check_box_switch" name="status" type="checkbox" data-off-text="Inactive" data-on-text="Active"  class="bs-switch add-status" />
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
                    <table id="datable_1" class="table table-hover display  pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Purchase Rate</th>
                            <th>Sell Rate</th>
                            <th>Alrert Qty</th>
                            <th>Status</th>
                            <th width="30%">Action</th>
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
                                    @if($inventory->status == '1')
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>
                                        <div class="row">
                                        <div style="width:50px;float:left;">
                                            <form method="GET" action="inventory/{{$item->id}}/edit">
                                                <button type="submit" class="btn btn-warning btn-icon-anim btn-square"><i class="fa fa-pencil"></i></button>
                                            </form>
                                        </div>

                                        <div style="width:50px;float:left;">
                                            <form method="GET" action="inventory/{{$item->id}}">
                                                <button type="submit" class="btn btn-dropbox btn-icon-anim btn-square"><i class="fa fa-eye"></i></button>
                                            </form>
                                        </div>

                                        <div style="width:50px;float:left;">
                                            <form method="post" action="inventory/{{$item->id}}" id="delete">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square" onclick="del();"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp
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

@endsection