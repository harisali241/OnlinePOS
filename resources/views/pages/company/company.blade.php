@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Companies</h5>

            <br><br>

            <a href="{{url('company/create')}}" class="btn btn-primary btn-anim"><strong><i class=" icon-plus "></i><span class="btn-text">ADD NEW</span></strong></a>


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
                            <th width="30%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>S.NO</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Phone NO</th>
                            <th>Status</th>
                            <th width="30%">Action</th>
                        </tr>
                        </tfoot>
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
                <div style="width:50px;float:left;">
                    <form method="GET" action="company/{{$company->id}}/edit">
                        <button type="submit" class="btn btn-warning btn-icon-anim btn-square"><i class="fa fa-pencil"></i></button>
                    </form>
                </div>

                <div style="width:50px;float:left;">
                        <form method="GET" action="company/{{$company->id}}">
                        <button type="submit" class="btn btn-dropbox btn-icon-anim btn-square"><i class="fa fa-eye"></i></button>
                    </form>
                </div>

                <div style="width:50px;float:left;">
                    <form method="post" action="company/{{$company->id}}" id="delete">
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