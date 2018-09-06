@extends('layouts.posMaster')
@section('content')

	<div class="row pr-20" style="height:100%;">  
		<div class="col-md-8 col-sm-6 hidden-xs big-two"></div>
		<div class="col-md-4 col-sm-6 col-xs-12 big-two">
			
			<div class="panel panel-default card-view" style="height:100%;">
				<div  class="panel-wrapper collapse in">
					<div  class="panel-body">
						<input type="text" name="items" class="form-control item-search">
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
							<tbody>
								<tr>
									<td>Sunsilk</td>
									<td>Rs 70</td>
									<td>1</td>
									<td>Rs 70</td>
									<td><i class="icon-trash"></i></td>
								</tr>
								<tr>
									<td>Lipton</td>
									<td>Rs 90</td>
									<td>5</td>
									<td>Rs 45</td>
									<td><i class="icon-trash"></td>
								</tr>
								<tr>
									<td>Lays</td>
									<td>Rs 10</td>
									<td>7</td>
									<td>Rs 70</td>
									<td><i class="icon-trash"></td>
								</tr>
								<tr>
									<td>Olpers</td>
									<td>Rs 250</td>
									<td>1</td>
									<td>Rs 250</td>
									<td><i class="icon-trash"></td>
								</tr>
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
	document.onkeydown = function(e) {
		if(e.keyCode == 27){
			alert('escapess')
		}   
	};
    $(document).ready(function(){

    	$('.item-search').keyup( function(){
    		var item = $(this).val();
    		$.ajax({
				url: 'getSearhItem',
				method: 'post',
				dataType: 'json',
				data: {'item':item , '_token': '{{csrf_token()}}' },
				success: function(data){
					console.log(data);
				}
			})
    	});
    	
    });
</script>
	
@endsection