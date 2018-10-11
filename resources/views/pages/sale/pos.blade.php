@extends('layouts.posMaster')
@section('content')
	

	<div class="askQty"></div>	

	<div class="row pr-20" style="height:100%;">  
		<div class="big-two tabItem" style="margin: 0 auto;">
			<div style="width:96%;margin-left:2%;height: 500px">
				<table class="listTable">
					<thead>
						<tr>
							<th width="30%">PRODUCT</th>
							<th width="20%">PRICE</th>
							<th width="20%">QTY</th>
							<th width="20%">TOTAL</th>
							<th width="10%"></th>
						</tr>
					</thead>
				</table>
				
				<div style="width: 100%;height: 400px; overflow-y:scroll;scroll-behavior:smooth;">
					<table class="listTable">
						<tbody style="border-top: solid 1px lightgray;" id="selction-ajax" class="CurrentItems">
							
						</tbody>
					</table>
				</div>
				
				<table class="listTable">
					<thead>
						<tr>
							<th width="50%"></th>
							<th align="right" width="30%">GRAND TOTAL</th>
							<th style="text-align: left;" width="30%">Rs <span class="grandTotal"></span></th>
						</tr>
					</thead>
				</table>
			</div>


		</div>
		<div class="big-two counter">
			
			<div class="panel panel-default card-view" style="height:100%;">
				<div  class="panel-wrapper collapse in">
					<div  class="panel-body">

						<div style="width: 100%;">
							<input type="text" name="items" class="form-control item-search" autofocus>
							<div class="searching-item"></div>
							{{-- <input type="text" name="country" id="autocomplete-ajax" class="form-control" style="height:70px;font-size:30px;border:solid 2px  #575a60;"> --}}
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
		//console.log(id);
		html = `
			<div class="modal fade setQtyOfitem" tabindex="-1" role="dialog" aria-hidden="true">
			    <div class="modal-dialog modal-lg" style="width:400px;">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			                <h5 class="modal-title">Short Key</h5>
			            </div>
			            <div class="modal-body">
			                <h5 class="mb-15">Overflowing text to show scroll behavior</h5>
			                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
			                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
			            </div>
			        </div>
			    </div>
			</div>
		`;
		$('.askQty').html(html);

		//thisItems(id, name, rate, qty);
	}

	function thisItems(id, name, rate, qty){
		$('.searching-item').html('');
		var get_id = $('.removeTR'+id).parent().parent('.parTr').find('.itemID'+id).text();
		if(get_id != ''){
			clickPlus(id);
		}else{
			var tr = `
				<tr class="parTr">
				    <td style="display:none;" class="itemID`+id+`">`+id+`</td>
					<td class="itemName" width="30%;">`+name+`</td>
					<td width="20%">Rs <span class="rate">`+rate+`<span></td>
					<td class="qtyCon" width="20%">
						<input type="button" value="-" class="minus`+id+` plus" onclick="clickMinus(`+id+`)">
						<input type="text" name="quantity" value="1" class="qty" readonly style="width:50px;"/>
						<input type="button" value="+" class="plus`+id+` minus" onclick="clickPlus(`+id+`)">
					</td>
					<td class="itemTotal`+id+`" width="20%">`+rate+`</td>
					<td width="10%"><div class="removeTR`+id+`" onclick="remo(`+id+`)"><i class="icon-trash"></i></div></td>
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
				url: 'getSearchItem',
				method: 'post',
				dataType: 'json',
				data: {'item':item , '_token': '{{csrf_token()}}' },
				success: function(data){
					console.log(data);
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
					
					console.log(data);
				}
			})
    	});
    	
    	document.onkeydown = checkKey;

		function checkKey(e) {
		    e = e || window.event;
		    if (e.keyCode == '38') {
		       alert('up');
		    }
		    else if (e.keyCode == '40') {
		      
		    }
		}
    });

</script>
	
@endsection

			{{-- <table class="listTable">
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

					<tr>
						<td>asdas</td>
						<td>asf</td>
						<td>QasfasaTY</td>
						<td>asfasfas</td>
						<td>w</td>
					</tr>
					<tr>
						<td>asdas</td>
						<td>asf</td>
						<td>QasfasaTY</td>
						<td>asfasfas</td>
						<td>w</td>
					</tr>
					<tr>
						<td>asdas</td>
						<td>asf</td>
						<td>QasfasaTY</td>
						<td>asfasfas</td>
						<td>w</td>
					</tr>
					<tr>
						<td>asdas</td>
						<td>asf</td>
						<td>QasfasaTY</td>
						<td>asfasfas</td>
						<td>w</td>
					</tr>

				</tbody>	
			</table>
			<table class="listTable" style="position: relative; bottom: 0px">
				<thead>
					<tr>
						<th></th>
						<th></th>
						<th align="left">GRAND TOTAL</th>
						<th align="left">Rs <span class="grandTotal"></span></th>
						<th></th>
					</tr>
				</thead>
			</table> --}}