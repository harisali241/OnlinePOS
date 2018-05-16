@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Branches</h5>

            <br><br>

            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success btn-anim">Add Branch</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Branch</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" action="{{route('branch.store')}}">
                            {{csrf_field()}}

                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="row p-10">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Companies<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="company_id">
                                                        <option disabled selected value="0">Select Company</option>
                                                        @foreach($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="branch_name" placeholder="Enter Branch Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Address</label>
                                                    <textarea class="form-control" name="branch_address" rows="3" placeholder="Enter Branch Address"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">PhoneNo<span class="text-danger">*</span></label>
                                                    <input required  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" class="form-control" name="branch_phoneNo" placeholder="Enter Phone No">
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
                            <th>Address</th>
                            <th>Phone NO</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($branches as $branch)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$branch->companies->company_name}}</td>
                                <td>{{$branch->branch_name}}</td>
                                <td>{{$branch->branch_address}}</td>
                                <td>{{$branch->branch_phoneNo}}</td>
                                <td>
                                    @if($branch->status === 1)
                                        <b style="color: red">Active</b>
                                    @else
                                        <b style="color: grey">Inactive</b>
                                    @endif
                                </td>
                                <td>

                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $branch->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post" action="branch/{{$branch->id}}" id="delete">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}

                                                <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del();"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @php $i++; @endphp

                            {{-- Edit Modal --}}
                            <div class="modal fade bs-example-modal-edit{{ $branch->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Branch</h5>
                                        </div>
                                        {!! Form::model($branch, ['method' => 'PATCH','url' => ['branch', $branch->id],
                                         'files'=>true,'class' => 'branch_add_submit_edit','role' => 'form' ]) !!}

                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="row p-10">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Companies<span class="text-danger">*</span></label>
                                                                    {!! Form::select('company_id' ,$edit_companies, null ,['class' => 'form-control select2',
                                                                    'id' => 'company_id'.$branch->id] ) !!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                                                                    {!! Form::text('branch_name' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Branch Name','id' => 'branch_name'.$branch->id,'required' => 'required'] ) !!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Address</label>
                                                                    {!! Form::textarea('branch_address' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Address','rows' => '3'] ) !!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">PhoneNo<span class="text-danger">*</span></label>
                                                                    {!! Form::text('branch_phoneNo' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Phone No','id' => 'branch_phoneNo'.$branch->id,'required' => 'required'] ) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label">Status<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-success radio-inline">
                                                                            {!! Form::radio('status', 1,['id' => 'radio1'.$branch->id]) !!}
                                                                            <label for="radio1{{ $branch->id }}"> Active </label>
                                                                        </div>

                                                                        <div class="radio radio-info radio-inline">
                                                                            {!! Form::radio('status', 0,['id' => 'radio12'.$branch->id]) !!}
                                                                            <label for="radio12{{ $branch->id }}"> In Active </label>
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

                            {{-- Edit Modal --}}
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
                confirmButtonColor: "red",
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