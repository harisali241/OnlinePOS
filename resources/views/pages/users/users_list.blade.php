@extends('layouts.master')

@section('content')

    <div class="row heading-bg">

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Users</h5>
        </div>

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">
            <a href="{{ url('users/create') }}"
                    class="btn btn-success btn-anim">Create +</a>
        </div>

        <div class="col-sm-12">
            <hr>
        </div>



    </div>

    {{-- Table --}}

    <!-- Row -->
    <div class="row">

        <div class="col-sm-12 mt-20">
            <div class="table-wrap">
                <div class="table-responsive">

                    <table id="datable_1" class="table table-hover display  pb-30" >

                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Branch Name</th>
                            <th>Full Name</th>
                            <th>username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        @php $i = 1; @endphp
                        @foreach($users as $user)
                            <tr>
                                <td>{!! $i !!}</td>

                                <td>{{ ($user->branch_id !== null) ? $user->branches->branch_name : 'No Branch'}}</td>
                                <td>{{$user->firstName.' '.$user->lastName}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                @if($user->status === 1)
                                    <td>Active</td>
                                @else
                                    <td>In Active</td>
                                @endif
                                <td>

                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <a href="{{ url('users/'.$user->id.'/edit') }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></a>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post"  action="{{ url('users/'.$user->id) }}" id="delete{{$user->id}}">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del({{$user->id}});"><i class="fa fa-trash"></i></button>
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

    {{-- Table --}}


@endsection

@section('script')

    <script type="text/javascript">

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