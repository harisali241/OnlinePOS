@extends('layouts.master')
@section('content')

    <form action="{{ url('/sale') }}" method="POST" role="form" id="sale_add_form">
        {{csrf_field()}}


        <div class="row">

            <div class="col-sm-8">
                <div class="panel panel-default card-view">
                	<div class="row" align="center">
                	    <h5>Create Sale</h5>
                	    <hr>
                	</div>

                	<div class="row p-20">

                		<div class="form-group col-sm-6">
                		    <label for="Item Name" class="control-label"><b>Sale Number</b><span class="text-danger">*</span></label>
                		    <input type="text" class="form-control small-input" id="sale_nmbr" value="{{$random}}" readonly name="sale_master_no" required placeholder="Sale Number">
                		</div>

                		<div class="form-group col-sm-6">
                		    <label for="Item Name" class="control-label">Date<span class="text-danger">*</span></label>
                		    <input type="date" class="form-control small-input" id="sale_Date"  name="sale_Date" required value="{{ date('Y-m-d',strtotime( \Carbon\Carbon::now())) }}">
                		</div>

                		<div class="form-group col-sm-6">
                		    <label for="Account" class="control-label">Customer Name<span class="text-danger">*</span></label>
                		    <select class="form-control select2 small-input" name="customer_id" id="customer_id">
                		        <option disabled selected value="0">Select Customer</option>
                		        @foreach($customers as $customer)
                		            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                		        @endforeach
                		    </select>
                		</div>

                		<div class="form-group col-sm-6">
                		    <label for="Account" class="control-label">Terminal Name<span class="text-danger">*</span></label>
                		    <select class="form-control select2 small-input" name="terminal_id" id="terminal_id">
                		        <option disabled selected value="0">Select Terminal</option>
                		        @foreach($terminals as $terminal)
                		            <option value="{{ $terminal->id }}">{{ $terminal->terminal_name }}</option>
                		        @endforeach
                		    </select>
                		</div>

                		<div class="form-group col-sm-12">
                		    <label for="Item Name" class="control-label">Branch Name<span class="text-danger">*</span></label>
                		    @if(Auth::user()->role_id == 2)
                		        <select class="form-control select2" id="branch_id" name="branch_id">
                		            <option value="0" selected disabled>Select Branches</option>
                		            @foreach($branches as $branch)
                		                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                		            @endforeach
                		        </select>
                		    @elseif(Auth::user()->role_id == 3  )
                		        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}">
                		    @endif
                		</div>
                		
                	</div>

                	<div class="row" align="center">
                	    <hr>
                	    <h5>Item List</h5>
                	    <hr>
                	</div>

                	<div class="row p-20" style="min-height: 200px;">
                	    <div class="table-wrap">
                	        <div class="table-responsive">
                	            <table class="table table-hover display pb-10" >
                	                <thead>
                	                <tr>

                	                    <th>Item Name</th>

                	                    <th>QTY</th>
                	                    <th>Rate/qnt</th>
                	                    <th>Total Amount</th>
                	                    <th>Action</th>
                	                </tr>
                	                </thead>
                	                <tbody class="item_here">

                	                </tbody>
                	            </table>
                	        </div>
                	    </div>

                	</div>

                </div>
            </div>

            <div class="col-sm-4">
            	<div class="panel panel-default card-view">
            		<div class="row" align="center">
                        <h5>Add Item</h5>
                        <hr>
                    </div>
                    <div class="row p-20">

                        <div class="form-group col-sm-12">
                            <label for="Account" class="control-label">Item<span class="text-danger">*</span></label>
                            <select class="form-control select2 item_detail">
                                <option disabled selected>Select Items</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">QTY<span class="text-danger">*</span></label>
                            <input type="text" class="form-control qnt small-input"  name="alert_qty" placeholder="Quantity">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Rate/QTY<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control rate small-input"  name="alert_qty" placeholder="Rate">
                                <span class="input-group-addon">Rs</span>
                            </div>
                        </div>

                        <div class="form-group col-sm-12" align="right">
                            <button type="button" class="btn btn-warning addNew_item">Add</button>
                        </div>

                    </div>

                    <div class="row" align="center">
                        <hr>
                        <h5>Grand Total</h5>
                        <hr>
                    </div>

                    <div class="row p-20">


                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Total Items</label>
                            <input type="text" class="form-control total_item" readonly value="0">
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Grand Total</label>
                            <div class="input-group">
                                <input type="text" name="grand_total" class="form-control grand_total" readonly value="0">
                                <span class="input-group-addon">Rs</span>
                            </div>
                        </div>

                    </div>
                    <div class="row p-20">
                        <hr>
                        <div class="form-group col-sm-12" align="right">
                            <button type="submit" class="btn btn-success addNew-check">Save</button>

                        </div>

                    </div>
            	</div>
            </div>

        </div>

    </form>

@endsection

@section('script')

    <script type="text/javascript">

        var grand_total = 0;
        var total_items = 0;
        var allowsubmit = 0;

        $('.addNew_item').click(function () {
            var item_id = $('.item_detail').val();
            var qnt = $('.qnt').val();
            var rate = $('.rate').val();
            var item_name = $('.item_detail option:selected').text();
            var html = '';
            if(item_id !== 0 && qnt !== '' && rate !== '')
            {
                html += `
                    <tr>
                        <td>
                            `+item_name+`
                            <input type="hidden" name="item_id[]" value="`+item_id+`"/>
                        </td>
                        <td>
                            `+qnt+`
                            <input type="hidden" class="item_qnt" name="qnt[]" value="`+qnt+`"/>
                        </td>
                        <td>
                            `+rate+`
                            <input type="hidden" class="item_rate" name="rate[]" value="`+rate+`"/>
                        </td>
                        <td>
                            `+qnt*rate+`
                            <input type="hidden" class="item_total" name="total_amount[]" value="`+qnt*rate+`"/>
                        </td>
                        <td>
                           <button type="button" class="btn btn-xs btn-danger remove_row"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                `;

                $('.item_here').append(html);
                grand_total+= qnt*rate;
                total_items+= 1;

                $('.total_item').val(total_items);
                $('.grand_total').val(grand_total);
            }
            else {
                swal({
                    title: "Required!",
                    text: "PLease Enter Require Fields!",
                    confirmButtonColor: "#0098a3",
                });
            }
        });

        $('body').on('click','.remove_row',function () {
            var qnt = $(this).parent().parent().find('.item_qnt').val();
            var rate = $(this).parent().parent().find('.item_rate').val();
            var total_amount = $(this).parent().parent().find('.total_amount').val();

            $(this).parent().parent().remove();

            grand_total-= qnt*rate;
            total_items-= 1;

            $('.total_item').val(total_items);
            $('.grand_total').val(grand_total);

        });

        $('#purchase_add_form').on('submit',function (e) {
            var sale_number = $('#sale_nmbr').val();

            var branch_id = $('#branch_id').val();
            var customer_id = $('#customer_id').val();
           if(allowsubmit === 0)
           {
               e.preventDefault();


               if(sale_number !== '' && branch_id*1 !== 0 && customer_id*1 !== 0 && total_items !== 0)
               {
                   allowsubmit = 1;
                   $(this).submit();
               }
               else {
                   swal({
                       title: "Required!",
                       text: "PLease Enter Require Fields!",
                       confirmButtonColor: "#0098a3",
                   });
               }

           }
        });
    </script>

@endsection