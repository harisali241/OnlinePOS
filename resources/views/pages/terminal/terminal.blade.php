@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Terminals</h5>

            <br><br>

            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
            class="btn btn-success btn-anim">Add Terminal</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Terminal</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" id="terminal_submit" action="{{route('terminal.store')}}">
                            {{csrf_field()}}

                            <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="row p-10">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Company Name</label>
                                                <input type="text" class="form-control" name="" required id="company_name" value="{{ $company }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Branch Name</label>
                                                <input type="text" class="form-control" name="" required id="branch_name" value="{{ $branch }}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Terminal Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="terminal_name" required id="terminal_name" placeholder="Enter Terminal Name">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Terminal Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="terminal_code" required id="terminal_code" placeholder="Enter Terminal Code">
                                            </div>
                                        </div>
                                        

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                <div>
                                                    <div class="radio radio-success radio-inline">
                                                        <input type="radio" name="status" id="radio1" value="1" checked>
                                                        <label for="radio1"> Active </label>
                                                    </div>

                                                    <div class="radio radio-info radio-inline">
                                                        <input type="radio" name="status" id="radio2" value="0">
                                                        <label for="radio2"> In Active </label>
                                                    </div>
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
                            <th>Branch Name</th>
                            <th>Terminal Name</th>
                            <th>Terminal Code</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                       
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($terminals as $terminal)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$company}}</td>
                                <td>{{$branch}}</td>
                                <td>{{$terminal->terminal_name}}</td>
                                <td>{{$terminal->terminal_code}}</td>
                                <td>
                                    @if($terminal->status == '1')
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $terminal->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post" action="terminal/{{$terminal->id}}" id="delete">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del();"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @php $i++; @endphp

                            {{--edit Modal--}}
                            <div class="modal bs-example-modal-edit{{ $terminal->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Terminal</h5>
                                        </div>
                                        {!! Form::model($terminal, ['method' => 'PATCH','url' => ['terminal', $terminal->id],
                                         'files'=>true,'class' => 'terminal_add_submit_edit','role' => 'form' ]) !!}

                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="row p-10">

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Company Name</label>
                                                                    {!! Form::text('company_name' , $company ,['class' => 'form-control','required' => 'required', 'readonly' => 'readonly'] ) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Branch Name</label>
                                                                    {!! Form::text('branch_name' , $branch ,['class' => 'form-control','required' => 'required', 'readonly' => 'readonly'] ) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Terminal Name<span class="text-danger">*</span></label>
                                                                    {!! Form::text('terminal_name' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Terminal Name','id' => 'terminal_name'.$terminal->id,'required' => 'required'] ) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Terminal Code<span class="text-danger">*</span></label>
                                                                    {!! Form::text('terminal_code' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Terminal Code','id' => 'terminal_code'.$terminal->id,'required' => 'required'] ) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-success radio-inline">
                                                                            {!! Form::radio('status', 1,['id' => 'radio1'.$terminal->id]) !!}
                                                                            <label for="radio1{{ $terminal->id }}"> Active </label>
                                                                        </div>

                                                                        <div class="radio radio-info radio-inline">
                                                                            {!! Form::radio('status', 0,['id' => 'radio12'.$terminal->id]) !!}
                                                                            <label for="radio12{{ $terminal->id }}"> In Active </label>
                                                                        </div>
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