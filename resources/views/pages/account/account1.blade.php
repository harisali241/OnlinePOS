@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Accounts</h5>

            <br><br>

            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success btn-anim">Add Account</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" style="width: 45%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Account</h5>
                        </div>
                        <form data-toggle="validator" role="form" method="POST" action="{{route('account.store')}}">
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
                                                    <label for="inputName" class="control-label mb-10">Account Nature<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="nature_id">
                                                        <option disabled selected>Select Account Nature</option>
                                                        @foreach($natures as $nature)
                                                            <option value="{{$nature->id}}">{{$nature->nature_name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Account Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="account_name" placeholder="Enter Account Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Account Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="account_number" placeholder="Enter Account Number">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Description<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="account_desc" placeholder="Enter Description">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Contact No<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="account_contactNo" placeholder="Enter Contact Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Address<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="account_address" placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Opening Credit<span class="text-danger">*</span></label>
                                                    <input id="tch2" type="text" value="0" class=" form-control tch2" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" required name="opening_credit" placeholder="Enter Opening Credit">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Opening Debit<span class="text-danger">*</span></label>
                                                    <input id="tch2" type="text" value="0" class=" form-control tch2" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" required name="opening_debit" placeholder="Enter Opening Debit">
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
                            <th>Account Nature</th>
                            <th>Account Name</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($accounts as $account)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$company}}</td>
                                <td>{{$account->branches->branch_name}}</td>
                                <td>{{$account->account_natures->nature_name}}</td>
                                <td>{{$account->account_name}}</td>
                                <td>

                                    <div class="row" align="center">
                                        <div class="col-sm-3" align="center">
                                            <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $account->id }}"
                                                    class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                                        </div>
                                        <div class="col-sm-3" align="center">

                                            <form method="post" action="account/{{$account->id}}" id="delete">
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
                            <div class="modal fade bs-example-modal-edit{{ $account->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h5 class="modal-title" id="myLargeModalLabel">Edit Account</h5>
                                        </div>
                                        {!! Form::model($account, ['method' => 'PATCH','url' => ['account', $account->id],
                                         'files'=>true,'class' => 'account_add_submit_edit','role' => 'form' ]) !!}

                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="row p-10">

                                                        {!! Form::hidden('nature_id' , null ,['class' => 'form-control','id' => 'nature_id'.$account->id,'required' => 'required'] ) !!}
                                                        
                                                        {!! Form::hidden('branch_id' , null ,['class' => 'form-control','id' => 'branch_id'.$account->id,'required' => 'required'] ) !!}

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label mb-10">Accounts Name<span class="text-danger">*</span></label>
                                                                {!! Form::text('accounts_name' , null ,['class' => 'form-control',
                                                                'placeholder' => 'Enter Account Name','id' => 'accounts_name'.$account->id,'required' => 'required'] ) !!}

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



    <script type="text/javascript">

        $(document).ready(function (e) {
            $('.branchId').attr('disabled', 'disabled');

            $(".companyId").on('change', function () {
                $('.branchId').text('');
                var id = $(this).val();

                $.ajax({
                    url:'/reqBranches',
                    method:'POST',
                    dataType:'JSON',
                    data:{ 'id' : id , '_token': '{{csrf_token()}}' },
                    success: function (data) {

                        $('.branchId').removeAttr('disabled');

                        $('.branchId').append('<option disabled selected>Select Branch</option>');

                        data.forEach(function (result) {
                            $('.branchId').append('<option value="'+result.id+'">'+result.branch_name+'</option>');
                            //console.log(result.branch_name);
                        })

                    },
                });
            });
        });


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