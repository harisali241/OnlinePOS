@extends('layouts.master')

@section('content')

<div class="row heading-bg">

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Accounts</h5>
        </div>

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">
            <button type="button" data-toggle="modal" data-target=".bs-example-modal-lg"
            class="btn btn-success btn-anim">Create +</button>
        </div>

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
													<input type="text" class="form-control" required name="account_name" placeholder="Enter Account Name">
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
                        					        <input type="text" class="form-control" required name="account_number" placeholder="Enter Account Number" onkeypress='validate(event)'>
                        					    </div>
                        					</div>


                        					<div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Opening Credit<span class="text-danger">*</span></label>
                                                    <input id="tch2" type="text" value="0" class=" form-control tch2" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" required name="opening_credit" placeholder="Enter Opening Credit" onkeypress='validate(event)'>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputName" class="control-label mb-10">Opening Debit<span class="text-danger">*</span></label>
                                                    <input id="tch2" type="text" value="0" class=" form-control tch2" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default" required name="opening_debit" placeholder="Enter Opening Debit" onkeypress='validate(event)'>
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
    	        		    <th>Account Type</th>
    	        		    <th>Account Name</th>
    	        		    <th>Account No</th>
    	        		    <th>Current Credit</th>
    	        		    <th>Current Debit</th>
    	        		    <th>Branch Name</th>
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
    	        			        <td>{{$account->account_number}}</td>
    	        			        <td>{{ number_format($account->current_credit,3)}}</td>
    	        			        <td>{{number_format($account->current_debit,3)}}</td>
    	        			        <td>{{$account->branches->branch_name}}</td>

    	        			        <td>

    	        			            <div class="row" align="center">
    	        			                <div class="col-sm-3" align="center">
    	        			                    <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $account->id }}"
    	        			                            class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

    	        			                </div>
    	        			                <div class="col-sm-3" align="center">

    	        			                    <form method="post"  action="{{ url('account/'.$account->id) }}" id="delete{{$account->id}}">
    	        			                        {{csrf_field()}}
    	        			                        {{method_field("DELETE")}}

    	        			                        <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del({{$account->id}});"><i class="fa fa-trash"></i></button>
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
											<input type="hidden" name="current_credit" value="{{ $account->current_credit }}">
											<input type="hidden" name="current_debit" value="{{ $account->current_debit }}">
											<input type="hidden" name="opening_credit" value="{{ $account->opening_credit }}">
											<input type="hidden" name="opening_debit" value="{{ $account->opening_debit }}">
    	        			                <div class="modal-body">
    	        			                    <div class="row">
                                                    <div class="col-sm-1"></div>

    	        			                        <div class="col-sm-10">
    	        			                            <div class="row p-10">

                                                            {{-- Account Name --}}

    	        			                                <div class="col-sm-6">
    	        			                                    <div class="form-group">
    	        			                                        <label for="inputName" class="control-label mb-10">Accounts Name<span class="text-danger">*</span></label>
    	        			                                        {!! Form::text('account_name' , null ,['class' => 'form-control',
    	        			                                        'placeholder' => 'Enter Account Name','id' => 'accounts_name'.$account->id,'required' => 'required'] ) !!}

    	        			                                    </div>
    	        			                                </div>

                                                            {{-- Account Name --}}

                                                            {{-- Account Nature --}}

                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="inputName" class="control-label mb-10">Account Nature<span class="text-danger">*</span></label>
                                                                        {!! Form::select('nature_id',$edit_natures,null,
                                                                        ['class' => 'select2 form-control']) !!}
                                                                    </div>
                                                                </div>

                                                            {{-- Account Nature --}}

                                                            {{-- Branch --}}

                                                                @if(auth()->user()->role_id === 2)
                                                                    <div class="col-sm-6">
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

                                                            {{-- Account Number --}}

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Account Number<span class="text-danger">*</span></label>
                                                                    {!! Form::number('account_number' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Account Name','id' => 'account_number'.$account->id,'required' => 'required','maxlength' => '11'] ) !!}
                                                                </div>
                                                            </div>

                                                            {{-- Account Number --}}


                                                            {{-- Account Desc --}}

                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="control-label mb-10">Description<span class="text-danger">*</span></label>
                                                                    {!! Form::text('account_desc' , null ,['class' => 'form-control',
                                                                    'placeholder' => 'Enter Description','id' => 'account_desc'.$account->id,'required' => 'required'] ) !!}
                                                                </div>
                                                            </div>

                                                            {{-- Account Desc --}}

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


        function del(account_id){
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
                $("#delete"+account_id).submit();

            });
            return false;


        }

    </script>

@endsection