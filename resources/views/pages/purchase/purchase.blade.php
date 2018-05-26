@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Purchase</h5>


        </div>

    </div>
    <hr>
    <br>

    <form action="{{url('/purchase')}}" method="POST" role="form">
        {{csrf_field()}}


        <div class="row">
            <div class="form-group col-sm-2">
                <label for="Item Name" class="control-label"><b>Purchase Number</b><span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
            </div>


            <div class="form-group col-sm-2">
                <label for="Item Name" class="control-label">Company Name<span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
            </div>


            <div class="form-group col-sm-2">
                <label for="Item Name" class="control-label">Branch Name<span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-sm-2">
                <input type="text" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
            </div>

        </div>

        <div class="row">
            <div class="form-group col-sm-2">
                <label for="Account" class="control-label mb-10">Vendor Name<span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-sm-4">
                <select class="form-control select2 account-add" name="" style="background:#f2f2f2;" required>
                    <option disabled selected>Select Vendor</option>


                </select>
            </div>


            <div class="form-group col-sm-2">
                <label for="Item Name" class="control-label">Date<span class="text-danger">*</span></label>
            </div>
            <div class="form-group col-sm-4">
                <input type="date" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
            </div>

        </div>

    </form>
    <br>
    <hr>

    <div class="row">

        <div class="form-group col-sm-1"></div>

        <div class="form-group col-sm-1">
            <label for="Account" class="control-label mb-10">Item<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-sm-2">
            <select class="form-control select2 account-add" name="" style="background:#f2f2f2;" required>
                <option disabled selected>Select Items</option>


            </select>
        </div>


        <div class="form-group col-sm-1">
            <label for="Item Name" class="control-label">QTY<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-sm-1">
            <input type="text" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
        </div>


        <div class="form-group col-sm-1">
            <label for="Item Name" class="control-label">Rate<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-sm-1">
            <input type="text" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
        </div>

        <div class="form-group col-sm-1">
            <label for="Item Name" class="control-label">Amount<span class="text-danger">*</span></label>
        </div>
        <div class="form-group col-sm-1">
            <input type="text" class="form-control alert-qty"  name="alert_qty" style="background:#f2f2f2;" required>
        </div>

        <div class="form-group col-sm-1">
            <button type="submit" class="btn btn-success addNew-check">Add</button>
        </div>

        <div class="form-group col-sm-1"></div>

    </div>

    <hr>

    <!-- Row -->
    <div class="row">
        <div class="col-sm-12 mt-20">
            <div class="panel panel-default card-view">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table table-hover display pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Item Name</th>
                            <th>Vendor Name</th>
                            <th>QTY</th>
                            <th>Rate</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Potatost</td>
                                <td>Badshah Khan</td>
                                <td>500</td>
                                <td>15</td>
                                <td>7500</td>
                                <td>25/5/2018</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

@endsection

@section('script')

    <script type="text/javascript">

    </script>

@endsection