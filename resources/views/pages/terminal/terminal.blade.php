@extends('layouts.master')

@section('content')

<div class="row heading-bg">

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Terminal</h5>
        </div>

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">
            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
            class="btn btn-success btn-anim">Create +</button>
        </div>

        <div class="col-sm-12">
            <hr>
        </div>

                {{-- Add Modal --}}

                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">

                        <div class="modal-dialog" style="width: 95%;">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h5 class="modal-title" id="myLargeModalLabel">Add Terminal</h5>
                                </div>

                                <form data-toggle="validator" role="form" method="POST" id="form_add_for_terminals" action="{{route('terminal.store')}}">

                                    {{csrf_field()}}

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">

                                                <div class="row p-10">

                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="inputName" class="control-label mb-10">Terminal Name<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control small-input" required name="terminal_name" placeholder="Enter Terminal Name">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="inputName" class="control-label mb-10">Terminal Code<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control small-input" required name="terminal_code" placeholder="Enter Terminal Code" value="{{$random}}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="" class="control-label mb-10">Status<span class="text-danger">*</span></label>
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

                                                    @if(auth()->user()->role_id === 2)
                                                        <div class="col-sm-11">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="branch_id" id="branch_id">
                                                                    <option disabled selected value="0">Select Branch Name</option>
                                                                    @foreach($branches as $branch)
                                                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @elseif(auth()->user()->role_id === 3)
                                                        <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
                                                    @endif

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

                        </div>

                    </div>

                {{-- End Of Add Modal --}}

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
                            <th>Terminal Name</th>
                            <th>Terminal Code</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>

                            @php $i = 1; @endphp
                            @foreach($terminals as $terminal)
                                <tr>
                                    <td>{!! $i !!}</td>

                                    <td>{{$terminal->branches->branch_name}}</td>
                                    <td>{{$terminal->terminal_name}}</td>
                                    <td>{{$terminal->terminal_code}}</td>
                                    <td>

                                        <div class="row" align="center">
                                            <div class="col-sm-3" align="center">
                                                <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $terminal->id }}"
                                                        class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                            </div>
                                            <div class="col-sm-3" align="center">

                                                <form method="post"  action="{{ url('terminal/'.$terminal->id) }}" id="delete{{$terminal->id}}">
                                                    {{csrf_field()}}
                                                    {{method_field("DELETE")}}

                                                    <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del({{$terminal->id}});"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @php $i++; @endphp

                                {{-- Edit Modal --}}
                                <div class="modal fade bs-example-modal-edit{{ $terminal->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="width: 95%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h5 class="modal-title" id="myLargeModalLabel">Edit Terminal</h5>
                                            </div>
                                            {!! Form::model($terminal, ['method' => 'PATCH','url' => ['terminal', $terminal->id],
                                             'files'=>true,'class' => 'terminal_add_submit_edit','role' => 'form' ]) !!}

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-1"></div>

                                                    <div class="col-sm-10">
                                                        <div class="row p-10">

                                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Terminal Name<span class="text-danger">*</span></label>
                                                                    {!! Form::text('terminal_name' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter Terminal Name','id' => 'terminal_name'.$terminal->id,'required' => 'required'] ) !!}
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Terminal Code<span class="text-danger">*</span></label>
                                                                    {!! Form::text('terminal_code' , null ,['class' => 'form-control small-input',
                                                                    'placeholder' => 'Enter Terminal Code','id' => 'terminal_code'.$terminal->id,'required' => 'required'] ) !!}
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label mb-10">Status<span class="text-danger">*</span></label>
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

                                                            {{-- Branch --}}

                                                                @if(auth()->user()->role_id === 2)
                                                                    <div class="col-sm-11">
                                                                        <div class="form-group">
                                                                            <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                                                                            {!! Form::select('branch_id',$edit_branches,null,
                                                                            ['class' => 'select2 form-control']) !!}
                                                                        </div>
                                                                    </div>
                                                                @elseif(auth()->user()->role_id === 3)
                                                                    <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
                                                                @endif

                                                            {{-- Branch --}}

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

                                {{-- Edit Modal --}}

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
        var  submitFrom = 0;
        $('#form_add_for_terminals').on('submit',function (e) {
            var branch = $('#branch_id').val();
            if(submitFrom === 0)
            {
                e.preventDefault();
                if(branch*1 === 0)
                {
                    swal({
                        title: "Required!",
                        text: "PLease Select Branch!",
                        confirmButtonColor: "#0098a3",
                    });
                }
                else {
                    submitFrom = 1;
                }
            }
        });


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