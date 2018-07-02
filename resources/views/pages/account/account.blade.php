@extends('layouts.master')

@section('content')

<div class="row heading-bg">

	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

		<h5 class="txt-dark">Accounts</h5>

		<br><br>

		<button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
                    class="btn btn-success btn-anim">Add Account</button>

        {{-- Add Modal --}}

        	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">

        		<div class="modal-dialog" style="width: 95%;">

        			<div class="modal-content">

        				<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h5 class="modal-title" id="myLargeModalLabel">Add Account</h5>
                        </div>

                        <form data-toggle="validator" role="form" method="POST" id="form_add_for_accounts" action="{{route('account.store')}}">

                        	{{csrf_field()}}

                        	<div class="modal-body">

                        		<div class="row">
									<div class="col-sm-1"></div>
                        			<div class="col-sm-10">

                        				<div class="row p-10">
											<input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
											<div class="col-sm-4">
												<div class="form-group">
													<label for="inputName" class="control-label mb-10">Account Name<span class="text-danger">*</span></label>
													<input type="text" class="form-control small-input" required name="account_name" placeholder="Enter Account Name">
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label for="inputName" class="control-label mb-10">Account Nature<span class="text-danger">*</span></label>
													<select class="form-control select2" name="nature_id">

														@foreach($natures as $nature)
															<option value="{{$nature->id}}">{{$nature->nature_name}}</option>
														@endforeach

													</select>
												</div>
											</div>
											@if(auth()->user()->role_id === 2)
												<div class="col-sm-4">
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


                        					<div class="col-sm-4">
                        					    <div class="form-group">
                        					        <label for="inputName" class="control-label mb-10">Account Number<span class="text-danger">*</span></label>
                        					        <input type="text" class="form-control small-input" required name="account_number" placeholder="Enter Account Number">
                        					    </div>
                        					</div>


                        					<div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Opening Credit<span class="text-danger">*</span></label>
                                                    <input id="tch2" type="text" value="0" class=" form-control tch2" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" required name="opening_credit" placeholder="Enter Opening Credit">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Opening Debit<span class="text-danger">*</span></label>
                                                    <input id="tch2" type="text" value="0" class=" form-control tch2" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" required name="opening_debit" placeholder="Enter Opening Debit">
                                                </div>
                                            </div>

											<div class="col-sm-12">
												<div class="form-group">
													<label for="inputName" class="control-label mb-10">Description<span class="text-danger">*</span></label>
													<input type="text" class="form-control" required name="account_desc" placeholder="Enter Description">
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

        		</div>

        	</div>

        {{-- End Of Add Modal --}}
                        				
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
    	        			        <div class="modal-dialog" style="width: 95%;">
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


    	        			                                <div class="col-sm-4">
    	        			                                    <div class="form-group">
    	        			                                        <label for="inputName" class="control-label mb-10">Accounts Name<span class="text-danger">*</span></label>
    	        			                                        {!! Form::text('account_name' , null ,['class' => 'form-control small-input',
    	        			                                        'placeholder' => 'Enter Account Name','id' => 'accounts_name'.$account->id,'required' => 'required'] ) !!}

    	        			                                    </div>
    	        			                                </div>

    	        			                                <div class="col-sm-4">
                                                				<div class="form-group">
                                                    				<label for="inputName" class="control-label mb-10">Account Number<span class="text-danger">*</span></label>
                                                    				{!! Form::text('account_number' , null ,['class' => 'form-control small-input',
    	        			                                        'placeholder' => 'Enter Account Name','id' => 'account_number'.$account->id,'required' => 'required'] ) !!}
                                                				</div>
                                            				</div>

                                            				<div class="col-sm-4">
                                            				    <div class="form-group">
                                            				        <label for="inputName" class="control-label mb-10">Description<span class="text-danger">*</span></label>
                                            				        {!! Form::text('account_desc' , null ,['class' => 'form-control small-input',
    	        			                                        'placeholder' => 'Enter Description','id' => 'account_desc'.$account->id,'required' => 'required'] ) !!}
                                            				    </div>
                                            				</div>

                                            				<div class="col-sm-4">
                                            				    <div class="form-group">
                                            				        <label for="inputName" class="control-label mb-10">Contact No<span class="text-danger">*</span></label>
                                            				        {!! Form::text('account_contactNo' , null ,['class' => 'form-control small-input',
    	        			                                        'placeholder' => 'Enter Contact Number','id' => 'account_contactNo'.$account->id,'required' => 'required'] ) !!}
                                            				    </div>
                                            				</div>

                                            				<div class="col-sm-4">
                                            				    <div class="form-group">
                                            				        <label for="inputName" class="control-label mb-10">Address<span class="text-danger">*</span></label>
                                            				        {!! Form::text('account_Address' , null ,['class' => 'form-control small-input',
    	        			                                        'placeholder' => 'Enter Address','id' => 'account_Address'.$account->id,'required' => 'required'] ) !!}
                                            				    </div>
                                            				</div>

                                            				<div class="col-sm-4">
                                            				    <div class="form-group">
                                            				        <label for="inputName" class="control-label mb-10">Opening Credit<span class="text-danger">*</span></label>
                                            				        {!! Form::text('opening_credit' , null ,['class' => 'form-control tch2',
    	        			                                        'placeholder' => 'Enter Opening Credit','id' => 'opening_credit'.$account->id,'required' => 'required'] ) !!}
                                            				    </div>
                                            				</div>

                                            				<div class="col-sm-4">
                                            				    <div class="form-group">
                                            				        <label for="inputName" class="control-label mb-10">Opening Debit<span class="text-danger">*</span></label>
                                            				        {!! Form::text('opening_debit' , null ,['class' => 'form-control tch2',
    	        			                                        'placeholder' => 'Enter Opening Debit','id' => 'opening_debit'.$account->id,'required' => 'required'] ) !!}
                                            				    </div>
                                            				</div>

                                            				<div class="col-sm-4">
                                            				    <div class="form-group">
                                            				        <label for="inputName" class="control-label mb-10">Account Nature<span class="text-danger">*</span></label>

																	{!! Form::select('nature_id',$edit_natures,null,
																		['class' => 'select2 form-control']) !!}
                                            				    </div>
                                            				</div>

															@if(auth()->user()->role_id === 2)
																<div class="col-sm-4">
																	<div class="form-group">
																		<label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
																		{!! Form::select('branch_id',$edit_branches,null,
																		['class' => 'select2 form-control']) !!}
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
        $('#form_add_for_accounts').on('submit',function (e) {
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