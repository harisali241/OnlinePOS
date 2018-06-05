@extends('layouts.master')
@section('content')

    <form action="{{url('/purchase')}}" method="POST" role="form">
        {{csrf_field()}}


        <div class="row">

            <div class="col-sm-8">
                <div class="panel panel-default card-view">
                    <div class="row" align="center">
                        <h5>Create Purchase</h5>
                        <hr>
                    </div>
                    <div class="row p-20">
                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label"><b>Purchase Number</b><span class="text-danger">*</span></label>
                            <input type="text" class="form-control small-input"  name="alert_qty" required placeholder="Purchase Number">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Company Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control small-input"  name="alert_qty" required placeholder="Company Name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Branch Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control small-input"  name="alert_qty" required placeholder="Branch Name">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control small-input"  name="alert_qty" required placeholder="Date">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Account" class="control-label mb-10">Vendor Name<span class="text-danger">*</span></label>
                            <select class="form-control select2 small-input" name="" required>
                                <option disabled selected value="0">Select Vendor</option>
                            </select>
                        </div>
                    </div>

                    <div class="row" align="center">
                        <hr>
                        <h5>Item List</h5>
                        <hr>
                    </div>
                    <div class="row p-20" style="min-height: 200px;">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-hover display pb-10" >
                                    <thead>
                                    <tr>

                                        <th>Item Name</th>

                                        <th>QTY</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="item_here">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default card-view">
                    <div class="row" align="center">
                        <h5>Add Item</h5>
                        <hr>
                    </div>
                    <div class="row p-20">
                        <div class="form-group col-sm-12">
                            <label for="Account" class="control-label mb-10">Item<span class="text-danger">*</span></label>
                            <select class="form-control select2 item_detail">
                                <option disabled selected>Select Items</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">QTY<span class="text-danger">*</span></label>
                            <input type="text" class="form-control qnt small-input"  name="alert_qty" placeholder="Quantity">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Rate/QTY<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control rate small-input"  name="alert_qty" placeholder="Rate">
                                    <span class="input-group-addon">Rs</span>
                                </div>
                            </div>

                        <div class="form-group col-sm-12" align="right">
                            <button type="button" class="btn btn-warning addNew_item">Add</button>
                        </div>
                    </div>


                    <div class="row" align="center">
                        <hr>
                        <h5>Grand Total</h5>
                        <hr>
                    </div>
                    <div class="row p-20">


                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Total Items</label>
                            <input type="text" class="form-control total_item" disabled>
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Grand Total</label>
                            <div class="input-group">
                                <input type="text" class="form-control grand_total" disabled="disabled">
                                <span class="input-group-addon">Rs</span>
                            </div>
                        </div>

                    </div>
                    <div class="row p-20">
                        <hr>
                        <div class="form-group col-sm-12" align="right">
                            <button type="submit" class="btn btn-success addNew-check">Save</button>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </form>


@endsection

@section('script')

    <script type="text/javascript">
        $('.addNew_item').click(function () {
            var item_id = $('.item_detail').val();
            var qnt = $('.qnt').val();
            var rate = $('.rate').val();
            var item_name = $('.item_detail option:selected').text();

            if(item_id !== 0 && qnt !== '' && rate !== '')
            {

            }
        });
    </script>

@endsection