@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Account Natures</h5>

            <br><br>


            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success btn-anim">Add Account Nature</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Account Nature</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" id="nature_submit" action="{{route('nature.store')}}">
                            {{csrf_field()}}

                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="row p-10">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="" class="control-label">Nature Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nature_name" required id="nature_name" placeholder="Enter Account Nature Name">
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
                    <table id="datable_1" class="table table-hover display pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Nature Name</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($natures as $nature)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$nature->nature_name}}</td>
                                <td>
                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $nature->nature_id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">
                                            <form method="POST" action="{{ url('nature/'.$item->id) }}" id="delete{{$nature->id}}">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm" onclick="del({{$nature->id}});"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>




                                </td>
                            </tr>
                            @php $i++; @endphp
                            {{--edit Modal--}}
                            <div class="modal bs-example-modal-edit{{ $nature->nature_id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Company</h5>
                                        </div>
                                        {!! Form::model($nature, ['method' => 'PATCH','url' => ['nature', $nature->nature_id],
                                         'files'=>true,'class' => 'nature_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="row p-10">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="" class="control-label">Account Nature Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('nature_name' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Account Nature Name','id' => 'nature_name'.$nature->nature_id,'required' => 'required'] ) !!}

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

    <script>

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