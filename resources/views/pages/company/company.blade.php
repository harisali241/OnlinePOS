@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Companies</h5>

            <br><br>


            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
            class="btn btn-success btn-anim">Add Company</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Large modal</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" id="company_submit" action="{{route('company.store')}}">
                            {{csrf_field()}}

                            <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="row p-10">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Name</label>
                                                <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Phone No</label>
                                                <input type="text" class="form-control" name="company_phoneNo" id="company_phoneNo" placeholder="Enter Phone No">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Address</label>
                                                <textarea class="form-control" rows="3" name="company_address" id="company_address" placeholder="Enter Address"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Status</label>
                                                <div>
                                                    <input id="check_box_switch" name="status" type="checkbox" data-off-text="Inactive" data-on-text="Active"  class="bs-switch" />
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
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Phone NO</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($companies as $company)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$company->company_name}}</td>
                                <td>{{$company->company_address}}</td>
                                <td>{{$company->company_phoneNo}}</td>
                                <td>
                                    @if($company->status == '1')
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>
            <div class="row">
                <div style="float:left;">
                    <form method="GET" action="company/{{$company->id}}/edit">
                        <button type="submit" class="btn btn-warning btn-icon-anim btn-square btn-sm m-l-10"><i class="fa fa-pencil"></i></button>
                    </form>
                </div>

                <div style="float:left;">
                        <form method="GET" action="company/{{$company->id}}">
                        <button type="submit" class="btn btn-dropbox btn-icon-anim btn-square btn-sm m-l-10"><i class="fa fa-eye"></i></button>
                    </form>
                </div>

                <div style="float:left;">
                    <form method="post" action="company/{{$company->id}}" id="delete">
                        {{csrf_field()}}
                        {{method_field("DELETE")}}

                        <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-l-10" onclick="del();"><i class="fa fa-trash"></i></button>
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

    <script>

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