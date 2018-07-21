@extends('layouts.master')
@section('content')
    
    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Good Received Note</h5>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">

            <a href="{{url('grn/create')}}"><button type="button" class="btn btn-success btn-anim">Create +</button></a>

        </div>
        <div class="col-sm-12">
            <hr>
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
                            <th>Date</th>
                            <th>GRN Code</th>
                            <th>Total Quantity</th>
                            <th>Total Amount</th>
                            <th>Remaining Balance</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($grns as $grn)
                        @if($grn->complete == 0)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$grn->date  }}</td>
                                <td>{{$grn->grn_master_no}}</td>
                                <td>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @for($x=0; $x < sizeof($grn->g_r_n_details); $x++)
                                        @php
                                            $count = $count + $grn->g_r_n_details[$x]->qty;
                                        @endphp
                                    @endfor
                                    {{$count}}
                                </td>
                                <td>Rs {{$grn->total_amount}}</td>
                                <td>{{$grn->total_balance}}</td>
                                <td>
                                    @if($grn->complete == 1)
                                        <b style="color: green">Complete</b>
                                    @else
                                        <b style="color: purple">Pending...</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="col-sm-3" align="center">
                                        <form method="GET" action="grn/{{$grn->id}}">
                                            <button type="submit" class="btn btn-primary btn-icon-anim btn-square btn-sm "><i class="fa fa-eye"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-sm-3" align="center">
                                        <form method="GET" action="{{ url('grn/'.$grn->id.'/edit') }}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-warning btn-icon-anim btn-square btn-sm "><i class="fa fa-pencil"></i></button>
                                        </form>
                                    </div>
                                    <div class="col-sm-3" align="center">
                                        <form method="POST" action="{{ url('grn/'.$grn->id) }}" id="delete{{$grn->id}}">
                                            {{csrf_field()}}
                                            {{method_field("DELETE")}}
                                            <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm" onclick="del({{$grn->id}});"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>

                                </td>


                            </tr>
                            @endif
                            @php $i++; @endphp

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    </div>



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