@extends('layouts.posMaster')
@section('content')

	<div class="row pr-20" style="height:100%;">  
		<div class="big-two tabItem">
			<h1 align="center">Current Cart</h1>
			<table class="listTable">
				<thead>
					<tr>
						<th>PRODUCT</th>
						<th>PRICE</th>
						<th>QTY</th>
						<th>TOTAL</th>
						<th></th>
					</tr>
				</thead>
				<tbody class="CurrentItems">

				</tbody>
			</table>

			<table class="listTable" style="position: absolute; width: 58%; left:-20px; bottom:1px;">
				<thead>
					<tr>
						<th width="50%"></th>
						<th align="left">GRAND TOTAL</th>
						<th align="left">Rs <span class="grandTotal"></span></th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="big-two counter">
			
			<div class="panel panel-default card-view" style="height:100%;">
				<div  class="panel-wrapper collapse in">
					<div  class="panel-body">

						<div style="width: 100%;">
							<input type="text" name="items" class="form-control item-search">
							<div class="searching-item"></div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>


@endsection

@section('script')

<script type="text/javascript">

	function thisItem(id, name, rate, qty){
		$('.searching-item').html('');
		var get_id = $('.removeTR'+id).parent().parent('.parTr').find('.itemID'+id).text();
		if(get_id != ''){
			clickPlus(id);
		}else{
			var tr = `
				<tr class="parTr">
				    <td style="display:none;" class="itemID`+id+`">`+id+`</td>
					<td class="itemName">`+name+`</td>
					<td>Rs <span class="rate">`+rate+`<span></td>
					<td class="qtyCon">
						<input type="button" value="-" class="minus`+id+` plus" onclick="clickMinus(`+id+`)">
						<input type="text" name="quantity" value="1" class="qty" readonly style="width:50px;"/>
						<input type="button" value="+" class="plus`+id+` minus" onclick="clickPlus(`+id+`)">
					</td>
					<td class="itemTotal`+id+`">`+rate+`</td>
					<td><div class="removeTR`+id+`" onclick="remo(`+id+`)"><i class="icon-trash"></i></div></td>
				</tr>
			`;
			$('.CurrentItems').append(tr);
			var tot = $('.itemTotal'+id).text();
			var g_tot = $('.grandTotal').text();
			$('.grandTotal').text(+tot+ +g_tot);
		}
	}
	
	function clickPlus(id){
		$(document).ready(function(){
			var c_val = $('.plus'+id).parent('.qtyCon').find('.qty').val();
			$('.plus'+id).parent('.qtyCon').find('.qty').val(+c_val+1);
			var u_val = $('.plus'+id).parent('.qtyCon').find('.qty').val();
			var c_rate = $('.plus'+id).parent().parent('.parTr').find('.rate').text();
			var c_tot = $('.plus'+id).parent().parent('.parTr').find('.itemTotal'+id).text();
			$('.plus'+id).parent().parent('.parTr').find('.itemTotal'+id).text(+c_tot+ +c_rate);
			var g_tot = $('.grandTotal').text();
			$('.grandTotal').text(+g_tot+ +c_rate);
		})
	}

	function clickMinus(id){
		$(document).ready(function(){
			var c_val = $('.minus'+id).parent('.qtyCon').find('.qty').val();
			if(c_val != 1){
				$('.minus'+id).parent('.qtyCon').find('.qty').val(c_val-1);
				var u_val = $('.minus'+id).parent('.qtyCon').find('.qty').val();
				var c_rate = $('.minus'+id).parent().parent('.parTr').find('.rate').text();
				var c_tot = $('.minus'+id).parent().parent('.parTr').find('.itemTotal'+id).text();
				$('.minus'+id).parent().parent('.parTr').find('.itemTotal'+id).text(c_tot-c_rate);
				var g_tot = $('.grandTotal').text();
				$('.grandTotal').text(g_tot-c_rate);
			}
		})
	}

	function remo(id){
		var tot = $('.itemTotal'+id).text();
		var g_tot = $('.grandTotal').text();
		$('.grandTotal').text(g_tot-tot);
		$('.removeTR'+id).parent().parent('.parTr').remove();
	}


    $(document).ready(function(){

    	$('.searching-item').hide();
    	$('.item-search').keyup( function(){
    		var item = $(this).val();
    		$.ajax({
				url: 'getSearhItem',
				method: 'post',
				dataType: 'json',
				data: {'item':item , '_token': '{{csrf_token()}}' },
				success: function(data){
					var html = '';
					for (var i = 0; i < data.length; i++) {
						html += '<div class="itemsForSelect" onclick="thisItem('+data[i].id+', \''+data[i].name+'\'	, '+data[i].rate+', '+data[i].qty+');">'+data[i].name+'</div>';
					}
					if($('.item-search').val() != ''){
						$('.searching-item').show();
						$('.searching-item').html(html);
					}else{
						$('.searching-item').html('');
					}
					
					//console.log(data);
				}
			})
    	});
    	
    });
</script>
	
@endsection