@extends('layouts.master')
@section('content')
    
    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Purchase Order</h5>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">
            <a href="{{url('purchase/create')}}"><button type="button" class="btn btn-success btn-anim">Create +</button></a>
            <a href="{{url('purchase')}}"><button type="button" class="btn btn-secondary btn-anim" style="color:black;border:solid 1px lightgray;"><- Back</button></a>
        </div>
        <div class="col-sm-12">
            <hr>
        </div>

    </div>

        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 align="center">Complete Detail</h3>
                    </div>
                </div>
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              <tr>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td><a href="javascript:void(0)">Purchase Code</a></td>
                                <td>{{$purchase->purchase_master_no}}</td>
                              </tr>
                              <tr>
                                <td><a href="javascript:void(0)">Date</a></td>
                                <td>{{$purchase->date}}</td>
                              </tr>
                              <tr>
                                <td><a href="javascript:void(0)">Branch Name</a></td>
                                <td>{{$purchase->branches->branch_name}}</td>
                              </tr>
                              <tr>
                                <td><a href="javascript:void(0)">Vendor Name</a></td>
                                <td>{{$purchase->vendors->vendor_name}}</td>
                              </tr>
                              <tr>
                                <td><a href="javascript:void(0)">Status</a></td>
                                <td>
                                    @if($purchase->permission == 1)
                                        <b style="color: green">Permited</b>
                                    @else
                                        <form method="POST" action="{{ url('aprovel') }}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$purchase->id}}">
                                            <b style="color: purple">Pending...</b>
                                            <button type="submit" class="btn btn-primary"style="margin-left:20px">Give Aprovel</button>
                                        </form>
                                    @endif
                                </td>
                              </tr>
                            </tbody>
                            <thead>
                              <tr>
                                <th></th>
                                <th></th>
                              </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>

        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="table-wrap mt-10">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase->purchase_details as $item)
                                  <tr>
                                    <td>{{$item->inventories->item_name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->rate}}</td>
                                    <td>{{$item->amount}}</td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>


        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-4">
                <div class="table-wrap mt-20">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                              <tr>
                                <th>Grand Total :</th>
                                <th>{{$purchase->total_amount}}</th>
                              </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
                
            </div>
        </div>


@endsection
