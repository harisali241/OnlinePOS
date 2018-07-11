@extends('layouts.master')
@section('content')
    
    <div class="row heading-bg">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Manage Purchase Order</h5>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12" align="right">

            <a href="{{url('purchase/create')}}"><button type="button" class="btn btn-success btn-anim">Create +</button></a>

        </div>
        <div class="col-sm-12">
            <hr>
        </div>

         <!-- Row -->
    <div class="row">
        <div class="col-sm-12 mt-20">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table id="datable_1" class="table table-hover display pb-30" >
                        <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Date</th>
                            <th>Purchase Code</th>
                            <th>Total Quantity</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($purchaseOrder as $purchase)
                        @if($purchase->permission == 0)
                            <tr>
                                <td>{!! $i !!}</td>
                                <td>{{$purchase->date  }}</td>
                                <td>{{$purchase->purchase_master_no}}</td>
                                <td>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @for($x=0; $x < sizeof($purchase->purchase_details); $x++)
                                        @php
                                            $count = $count + $purchase->purchase_details[$x]->qty;
                                        @endphp
                                    @endfor
                                    {{$count}}
                                </td>
                                <td>Rs {{$purchase->total_amount}}</td>
                                <td>
                                    @if($purchase->permission == 1)
                                        <b style="color: green">Permited</b>
                                    @else
                                        <b style="color: purple">Pending...</b>
                                    @endif
                                </td>
                                <td>
                                    <div class="col-sm-3" align="center">
                                        <form method="GET" action="purchase/{{$purchase->id}}">
                                            <button type="submit" class="btn btn-primary btn-icon-anim btn-square btn-sm "><i class="fa fa-eye"></i></button>
                                        </form>
                                    </div>
                                    @if($purchase->permission == 0)
                                        <div class="col-sm-3" align="center">
                                            <form method="GET" action="{{ url('purchase/'.$purchase->id.'/edit') }}">
                                                {{csrf_field()}}
                                                <button type="submit" class="btn btn-warning btn-icon-anim btn-square btn-sm "><i class="fa fa-pencil"></i></button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="col-sm-3" align="center">
                                        <form method="POST" action="{{ url('purchase/'.$purchase->id) }}" id="delete{{$purchase->id}}">
                                            {{csrf_field()}}
                                            {{method_field("DELETE")}}
                                            <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm" onclick="del({{$purchase->id}});"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>

                                </td>


                            </tr>
                            @endif
                            @php $i++; @endphp

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

    </div>



@endsection

@section('script')
    
    <script type="text/javascript">

        var grand_total = 0;
        var total_items = 0;

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