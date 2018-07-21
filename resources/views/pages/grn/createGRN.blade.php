@extends('layouts.master')
@section('content')
    
    <form action="{{ url('/grn') }}" method="POST" role="form" id="grn_add_form">
        {{csrf_field()}}


        <div class="row">

            <div class="col-sm-8">
                <div class="panel panel-default card-view">
                    <div class="row" align="center">
                        <h5>Create Good Received Note</h5>
                        <hr>
                    </div>
                    <div class="row p-20">
                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label"><b>Good Received Number</b><span class="text-danger">*</span></label>
                            <input type="text" class="form-control small-input" id="grn_master_no" value="{{$random}}" readonly name="grn_master_no" required placeholder="Good Received Number">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control small-input" id="GRN_Date"  name="grn_Date" required value="{{ date('Y-m-d',strtotime( \Carbon\Carbon::now())) }}">
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Branch Name<span class="text-danger">*</span></label>
                            <select class="form-control select2 branch_id" id="branch_id" name="branch_id">
                                
                            </select>
                        </div>


                        <div class="form-group col-sm-6">
                            <label for="Account" class="control-label">Vendor Name<span class="text-danger">*</span></label>
                            <select class="form-control select2 vendor_id" id="vendor_id" name="vendor_id">
                                
                            </select>
                        </div>
                    </div>

                    <div class="row" align="center">
                        <hr>
                        <h5>Received Item List</h5>
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
                                        <th>Received QTY</th>
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
                        <h5>Place Purchase Order</h5>
                        <hr>
                    </div>
                    <div class="row p-20">
                        <div class="form-group col-sm-12">
                            <label for="Account" class="control-label">Purchase Order<span class="text-danger">*</span></label>
                            <select class="form-control select2 purchase_id" name="purchase_id">
                                <option disabled selected>Select Order</option>
                                @foreach($purchaseOrder as $purchase)
                                    <option value="{{ $purchase->id }}">Code No - {{ $purchase->purchase_master_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="form-group col-sm-12" align="right">
                            <button type="button" class="btn btn-warning select-PO">Select</button>
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

                        <input type="hidden" name="total_balance" class="form-control total_balance" value="">

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

        $(document).ready(function(){

            $('.select-PO').on('click', function(){

                if($('.purchase_id').val() == null){
                    swal({
                        title: "Order Not Selected!",
                        text: "PLease Select Order First",
                        confirmButtonColor: "#0098a3",
                    });
                }else{
                    var id = $('.purchase_id').val();
                    
                    $.ajax({
                        url:'/reqPO',
                        method:'POST',
                        dataType:'JSON',
                        data:{ 'id' : id , '_token': '{{csrf_token()}}' },
                        success: function (data) {
                            //console.log( data.purchase_details );
                            $('.branch_id').html('<option value="'+data.branch_id+'" selected>'+data.branches.branch_name+'</option>');
                            $('.vendor_id').html('<option value="'+data.vendor_id+'" selected>'+data.vendors.vendor_name+'</option>');
                            //$('.branch_id').val(data.branches.branch_name);
                            //$('.vendor_id').val(data.vendors.vendor_name);
                            $('.total_item').val( $(data.purchase_details).size() );
                            $('.grand_total').val(data.total_amount);
                            
                            var html = '';
                            $('.item_here').html('');
                            for(var i=0; i < $(data.purchase_details).size(); i++){
                                //console.log(data.purchase_details[i].inventories.item_name);
                                html += `
                                <tr>
                                    <td>
                                        `+data.purchase_details[i].inventories.item_name+`
                                        <input type="hidden" name="item_id[]" value="`+data.purchase_details[i].inventory_id+`"/>
                                    </td>
                                    <td>
                                        `+data.purchase_details[i].qty+`
                                        <input type="hidden" class="item_qnt" name="qty[]" value="`+data.purchase_details[i].qty+`"/>
                                    </td>
                                    <td>
                                        `+data.purchase_details[i].rate+`
                                        <input type="hidden" class="item_rate" name="rate[]" value="`+data.purchase_details[i].rate+`"/>
                                    </td>
                                    <td>
                                        `+data.purchase_details[i].amount+`
                                        <input type="hidden" class="item_total" name="total_amount[]" value="`+data.purchase_details[i].amount+`"/>
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="updateReceiveQty();" class="receive_qty form-control" style="background-color:lightGray;width:100px;" name="receive_qty[]" value="`+data.purchase_details[i].qty+`"/>
                                    </td>
                                </tr>
                                `;
                            };
                        $('.item_here').append(html);
                        },
                    });
                }
            });

            var allowsubmit = 0;
            $('#grn_add_form').on('submit',function (e) {
                var grn_number = $('grn_master_no').val();
                var total_items = $('.total_items').val();
                var branch_id = $('.branch_id').val();
                var vendor_id = $('.vendor_id').val();
               if(allowsubmit === 0)
               {
                   e.preventDefault();


                   if(grn_number !== '' && branch_id*1 !== 0 && vendor_id*1 !== 0 && total_items !== 0 && $("input[name^= 'item_id']").length != 0)
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
        });

        function updateReceiveQty(){

            $(document).ready(function(){
                var total_amount = 0 ;
                var total_qty = 0;
                var total_receive_qty = 0;

                for(var i=0; i < $("input[name^= 'receive_qty']").length; i++){
                    total_amount = +total_amount + +($("input[name^= 'receive_qty']").eq(i).val() * $("input[name^= 'rate']").eq(i).val())

                    total_qty = +total_qty + +$("input[name^= 'qty']").eq(i).val();
                    total_receive_qty = +total_receive_qty + +$("input[name^= 'receive_qty']").eq(i).val();
                }

                $('.grand_total').val(total_amount);
                var total_balance = total_qty - total_receive_qty;
                $('.total_balance').val(total_balance);

               // var item_qty = $('.total_item').val();
               //  for(var i=0; i < $("input[name^= 'receive_qty']").length; i++){
               //      if($("input[name^= 'receive_qty']").eq(i).val() <= 0 || $("input[name^= 'receive_qty']").eq(i).val() == ''){
               //          item_qty = +item_qty - 1;
               //      }else{
               //          //item_qty = +item_qty + 1;
               //      }
               //  }
               //  $('.total_item').val(item_qty);

            });
            
        }


    </script>

@endsection