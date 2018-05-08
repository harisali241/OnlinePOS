@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h5 class="txt-dark">Companies</h5>

            <br><br>
                <a href="{{url('company/create')}}" class="btn btn-primary btn-anim"><strong><i class=" icon-plus "></i><span class="btn-text">ADD NEW</span></strong></a>

            <a href="{{url('company')}}" class="btn btn-default btn-anim" style="float: right;"><strong><i class="icon-arrow-left-circle"></i><span class="btn-text">BACK</span></strong></a>
            <br><br>

        </div>

    </div>
        <br><br><br>
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-20"></div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mt-20">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">{{$company->company_name}}</h6>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div  class="panel-body row pa-0">
                        <table class="table table-hover mb-0">
                            <tbody>
                            <tr>
                                <th><strong>Company Name</strong></th>
                                <td>{{$company->company_name}}</td>
                            </tr>
                            <tr>
                                <th><strong>Address</strong></th>
                                <td>{{$company->company_address}}</td>
                            </tr>
                            <tr>
                                <th><strong>Phone No</strong></th>
                                <td>{{$company->company_phoneNo}}</td>
                            </tr>
                            <tr>
                                <th><strong>Status</strong></th>
                                <td>
                                    @if($company->status == '1')
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection