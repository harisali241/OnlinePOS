@extends('layouts.master')

@section('content')

<div class="row heading-bg">

        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Accounts Setting</h5>
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
                            <h5 class="modal-title" id="myLargeModalLabel">Add Account Setting</h5>
                        </div>

                        <form data-toggle="validator" role="form" method="POST" id="form_add_for_accounts" action="{{route('accountsetting.store')}}">
                        	{{csrf_field()}}

                        	<div class="modal-body">
                        		
                        		<div class="row">
                        			
                        			<div class="col-sm-1"></div>
                        			<div class="col-sm-10">
                        				<div class="row p-10">

                        					<div class="col-sm-12" id="branchchange">
                        						<div class="form-group">
                        							<label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                        							<select class="form-control select2 branch_id" name="branch_id" id="branch_id">
                        								<option disabled selected value="0">Select Branch Name</option>
                        								@foreach($branches as $branch)
                        									<option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                        								@endforeach

                        							</select>
                        						</div>
                        					</div>
											<div class="col-sm-12">
												<hr>
											</div>
                        					<div class="col-sm-4 hide" id="cus_account">
                        						<div class="form-group">
                        							<label for="inputName" class="control-label mb-10">Customer<span class="text-danger">*</span></label>
                        							<input type="hidden" name="module_name[]" id="module" value="Customer">
                        							<select class="form-control select2 account_id" name="account_id[]" id="account_id">                   

                        							</select>
                        						</div>
                        					</div>

                        					<div class="col-sm-4 hide" id="cus_account">
                        						<div class="form-group">
                        							<label for="inputName" class="control-label mb-10">Vendor<span class="text-danger">*</span></label>
                        							<input type="hidden" name="module_name[]" id="module" value="Vendor">
                        							<select class="form-control select2 account_id" name="account_id[]" id="account_id">                   

                        							</select>
                        						</div>
                        					</div>

                        					<div class="col-sm-4 hide" id="cus_account">
                        						<div class="form-group">
                        							<label for="inputName" class="control-label mb-10">Purchases<span class="text-danger">*</span></label>
                        							<input type="hidden" name="module_name[]" id="module" value="Purchases">
                        							<select class="form-control select2 account_id" name="account_id[]" id="account_id">                   

                        							</select>
                        						</div>
                        					</div>

                        					<div class="col-sm-4 hide" id="cus_account">
                        						<div class="form-group">
                        							<label for="inputName" class="control-label mb-10">Sales<span class="text-danger">*</span></label>
                        							<input type="hidden" name="module_name[]" id="module" value="Sales">
                        							<select class="form-control select2 account_id" name="account_id[]" id="account_id">                   

                        							</select>
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

        {{-- Add Modal --}}

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12 mt-20">
                <div class="table-wrap">
                    <div class="table-responsive">
                        <table id="datable_1" class="table table-hover display  pb-30" >

                            <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Module Name</th>
                                <th>Account Name</th>
                                <th width="15%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            	
                            	@php $i = 1; @endphp
                            	@foreach($accountsettings as $accountsetting)
                            	    <tr>
                            	        <td>{!! $i !!}</td>
                            	        <td>{{$accountsetting->module_name}}</td>
                            	        <td>{{$accountsetting->accounts->account_name}}</td>
                            	        <td>

                            	            <div class="row" align="center">
                            	                <div class="col-sm-3" align="center">
                            	                    <button type="button" data-toggle="modal" data-target=".bs-example-modal-edit{{ $accountsetting->id }}"
                            	                            class="btn btn-warning btn-icon-anim btn-square btn-sm m-b-5"><i class="fa fa-pencil"></i></button>

                            	                </div>
                            	                <div class="col-sm-3" align="center">

                            	                    <form method="post" action="{{ url('accountsetting/'.$accountsetting->id) }}" id="delete{{$accountsetting->id}}">
                            	                        {{csrf_field()}}
                            	                        {{method_field("DELETE")}}

                            	                        <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm m-b-5" onclick="del({{$accountsetting->id}});"><i class="fa fa-trash"></i></button>
                            	                    </form>
                            	                </div>
                            	            </div>

                            	        </td>
                            	    </tr>
                            	    @php $i++; @endphp

                            	    {{-- Edit Modal --}}
                            	    <div class="modal fade bs-example-modal-edit{{ $accountsetting->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            	        <div class="modal-dialog" style="width: 95%;">
                            	            <div class="modal-content">
                            	                <div class="modal-header">
                            	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            	                    <h5 class="modal-title" id="myLargeModalLabel">Edit Account setting</h5>
                            	                </div>
                            	                {!! Form::model($accountsetting, ['method' => 'PATCH','url' => ['accountsetting', $accountsetting->id],
                            	                 'files'=>true,'class' => 'accountsetting_add_submit_edit','role' => 'form' ]) !!}

                            	                <div class="modal-body">
                            	                    <div class="row">
                            	                        <div class="col-sm-1"></div>
                            	                        <div class="col-sm-10">
                            	                            <div class="row p-10">

                            	                                {!! Form::hidden('user_id' , $accountsetting->user_id ,['class' => 'form-control','id' => 'user_id'.$accountsetting->id,'required' => 'required'] ) !!}

                            	                                <div class="col-sm-4">
                            	                                    <div class="form-group">
                            	                                        <label for="inputName" class="control-label mb-10">Branch Name<span class="text-danger">*</span></label>
                            	                                        {!! Form::select('branch_id',$edit_branches,$accountsetting->branch_id,
                            	                                        ['class' => 'select2 form-control branch_id2','data-accountsettingid' => $accountsetting->id  ]) !!}
                            	                                    </div>
                            	                                </div>

                            	                                <div class="col-sm-4">
                            	                                    <div class="form-group">
                            	                                        <label for="inputName" class="control-label mb-10">{{$accountsetting->module_name}}<span class="text-danger">*</span></label>

                            	                                        {!! Form::hidden('module_name' , $accountsetting->module_name ,['class' => 'form-control','id' => 'module_name'.$accountsetting->id,'required' => 'required'] ) !!}



                            	                                        {!! Form::select('account_id',getAccountOfBranches($accountsetting->branch_id),$accountsetting->account_id,
                            	                                        ['class' => 'select2 form-control account_id'.$accountsetting->id]) !!}

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

</div>

@endsection

@section('script')

<script type="text/javascript">

	$(document).ready(function (e) {

	    $('.branch_id').change(function () {
	        var branch_id = $(this).val();

	        if(branch_id !== '')
	        {
	            $.ajax({
	                url:'/get_accounts',
	                method:'GET',
	                dataType:'JSON',
	                data:{ branch_id : branch_id },
	                success: function (response) {

	                	$('.hide').removeClass('hide');

	                	$('#branchchange').removeClass('col-sm-12');
	                	$('#branchchange').addClass('col-sm-12');

	                    var html = '<option value="" selected>Select Account</option>';

	                    response.forEach(function (data) {
	                        html+= '<option value="'+data.id+'">'+data.account_name+' ('+data.account_number+')</option>'
	                    });
	                    $('.account_id').html(html);
	                }
	            });
	        }
	        else{

                $('.hide').removeClass('hide');
                $('#branchchange').removeClass('col-sm-12');
                $('#branchchange').addClass('col-sm-4');

	            var html = '<option value="" selected>Select Account</option>';
	            $('.account_id').html(html);
	        }
	    });

	    $('.branch_id2').change(function () {
	        var branch_id = $(this).val();
	        var id = $(this).data('accountsettingid');

	        if(branch_id !== '')
	        {
	            $.ajax({
	                url:'/get_accounts',
	                method:'GET',
	                dataType:'JSON',
	                data:{ branch_id : branch_id },
	                success: function (response) {
	                    var html = '<option value="" selected>Select Account</option>';

	                    response.forEach(function (data) {
	                        html+= '<option value="'+data.id+'">'+data.account_name+' ('+data.account_number+')</option>'
	                    });
	                    $('.account_id'+id).html(html);
	                }
	            });
	        }
	        else{
	            var html = '<option value="" selected>Select Account</option>';
	            $('.account_id'+id).html(html);
	        }
	    });

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