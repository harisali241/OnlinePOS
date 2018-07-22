@extends('layouts.master')
@section('content')
    
   
    {!! Form::model($grn, ['method' => 'PATCH','url' => ['grn', $grn->id],'files'=>true,'class' => 'grn_details_add_submit_edit','role' => 'form' ]) !!}


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
                            {!! Form::text('grn_master_no' , $grn->grn_master_no ,['class' => 'form-control  small-input','id' => 'grn_master_no'.$grn->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Date<span class="text-danger">*</span></label>
                            {!! Form::date('grn_Date' , date('Y-m-d',strtotime( \Carbon\Carbon::now())) ,['class' => 'form-control  small-input','id' => 'grn_Date'.$grn->id,'required' => 'required'] ) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Branch Name<span class="text-danger">*</span></label>
                            {!! Form::text(null , $grn->branches->branch_name ,['class' => 'form-control branch_id small-input','id' => 'branch_id'.$grn->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
                            {!! Form::hidden('branch_id' , $grn->branch_id ,['class' => 'form-control branch_id small-input','id' => 'branch_id'.$grn->id] ) !!}
                        </div>


                        <div class="form-group col-sm-6">
                            <label for="Account" class="control-label">Vendor Name<span class="text-danger">*</span></label>
                            {!! Form::text(null , $grn->vendors->vendor_name ,['class' => 'form-control  small-input vendor_id','id' => 'vendor_id'.$grn->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
                             {!! Form::hidden('vendor_id' , $grn->vendor_id ,['class' => 'form-control vendor_id small-input','id' => 'vendor_id'.$grn->id] ) !!}
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
                                        @foreach($grn->g_r_n_details as $item)
                                            <tr>
                                                <td>
                                                    {{$item->inventories->item_name}}
                                                    <input type="hidden" name="item_id[]" value="{{$item->inventories->id}}"/>
                                                </td>
                                                <td>
                                                    {{$item->qty + $item->balance}}
                                                    <input type="hidden" class="item_qty" name="qty[]" value=" {{$item->qty + $item->balance}}"/>
                                                </td>
                                                <td>
                                                    {{$item->rate}}
                                                    <input type="hidden" class="item_rate" name="rate[]" value="{{$item->rate}}"/>
                                                </td>
                                                <td>
                                                    {{$item->amount}}
                                                    <input type="hidden" class="item_total" name="total_amount[]" value="{{$item->amount}}"/>
                                                </td>
                                                <td>
                                                   <input type="number" onkeyup="updateReceiveQty();" class="receive_qty form-control" style="background-color:lightGray;width:100px;" name="receive_qty[]" value="{{$item->qty}}"/>
                                                </td>
                                            </tr>
                                        @endforeach
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
                            {!! Form::text(null , $grn->purchase_masters->purchase_master_no ,['class' => 'form-control  small-input purchase_id','id' => 'purchase_id'.$grn->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
                            {!! Form::hidden('purchase_id',$grn->purchase_id ,['id' => 'purchase_id'.$grn->id] ) !!}
                        </div>
                        

                     {{--    <div class="form-group col-sm-12" align="right">
                            <button type="button" class="btn btn-warning select-PO">Select</button>
                        </div> --}}
                    </div>


                    <div class="row" align="center">
                        <hr>
                        <h5>Grand Total</h5>
                        <hr>
                    </div>
                    <div class="row p-20">


                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Total Items</label>
                            {!! Form::text('total_item' , count($grn->g_r_n_details) ,['class' => 'form-control  small-input','id' => 'total_item'.$grn->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Grand Total</label>
                            <div class="input-group">
                                {!! Form::text('grand_total' , $grn->total_amount ,['class' => 'form-control  small-input grand_total','id' => 'grand_total'.$grn->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
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
                console.log(total_balance);

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