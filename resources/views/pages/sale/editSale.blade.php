@extends('layouts.master')
@section('content')

    {!! Form::model($sale, ['method' => 'PATCH','url' => ['sale', $sale->id],'files'=>true,'class' => 'purchase_details_add_submit_edit','role' => 'form' ]) !!}


        <div class="row">

            <div class="col-sm-8">
                <div class="panel panel-default card-view">
                    <div class="row" align="center">
                        <h5>Edit Purchase</h5>
                        <hr>
                    </div>
                    <div class="row p-20">
<<<<<<< HEAD

=======
>>>>>>> 9dd727bbb6d234a48d94b64a5c23c301e500be54
                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label"><b>Purchase Number</b><span class="text-danger">*</span></label>
                            {!! Form::text('sale_master_no' , $sale->sale_master_no ,['class' => 'form-control  small-input','id' => 'sale_master_no'.$sale->id,'required' => 'required', 'readonly'=>'readonly'] ) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Item Name" class="control-label">Date<span class="text-danger">*</span></label>
                            {!! Form::date('sale_Date' , date('Y-m-d',strtotime( \Carbon\Carbon::now())) ,['class' => 'form-control  small-input','id' => 'sale_Date'.$sale->id,'required' => 'required'] ) !!}
                        </div>


                        <div class="form-group col-sm-6">
                            <label for="Account" class="control-label">Terminal Name<span class="text-danger">*</span></label>
                            {!! Form::select('terminal_id',$terminals,null,['class' => 'select2 form-control small-input']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="Account" class="control-label">Customer Name<span class="text-danger">*</span></label>
                            {!! Form::select('customer_id',$customers,null,['class' => 'select2 form-control small-input']) !!}
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Branch Name<span class="text-danger">*</span></label>
                            @if(Auth::user()->role_id == 2)
                                {!! Form::select('branch_id',$branches,null,['class' => 'select2 form-control small-input']) !!}
                            @elseif(Auth::user()->role_id == 3  )
                                {!!Form::hidden('branch_id', Auth::user()->branch_id)!!}
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
                                        @foreach($sale->sale_details as $item)
                                            <tr>
                                                <td>
                                                    {{$item->inventories->item_name}}
                                                    <input type="hidden" name="item_id[]" value="{{$item->inventories->id}}"/>
                                                </td>
                                                <td>
                                                    {{$item->qty}}
                                                    <input type="hidden" class="item_qnt" name="qnt[]" value="{{$item->qty}}"/>
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
                                                   <button type="button" class="btn btn-xs btn-danger remove_row"><i class="fa fa-trash"></i></button>
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
                        <h5>Add Item</h5>
                        <hr>
                    </div>
                    <div class="row p-20">
                        <div class="form-group col-sm-12">
                            <label for="items" class="control-label">Item<span class="text-danger">*</span></label>
                            {!! Form::select('item_detail',$items,null,['class' => 'select2 form-control small-input item_detail']) !!}
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
                            <input type="text" class="form-control total_item" readonly value="{{ count($sale->sale_details) }}">
                        </div>

                        <div class="form-group col-sm-12">
                            <label for="Item Name" class="control-label">Grand Total</label>
                            <div class="input-group">
                                <input type="text" name="grand_total" class="form-control grand_total" readonly value="{{ $sale->total_amount }}">
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

        var grand_total = $('.grand_total').val();;
        var total_items = $('.total_item').val();;

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
                grand_total = +grand_total + +qnt*rate;
                total_items = +total_items + 1;

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

        var allowsubmit = 0;
        $('#purchase_add_form').on('submit',function (e) {
            var purchase_number = $('#purchase_nmbr').val();

            var branch_id = $('#branch_id').val();
            var vendor_id = $('#vendor_id').val();
           if(allowsubmit === 0)
           {
               e.preventDefault();


               if(purchase_number !== '' && branch_id*1 !== 0 && vendor_id*1 !== 0 && total_items !== 0)
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