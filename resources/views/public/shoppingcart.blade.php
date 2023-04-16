
@extends('common') 

@section('pagetitle')
Shopping Cart
@endsection

@section('pagename')
Laravel Project
@endsection


@section('content')
	

<div class="row">
	<div class="col-md-5 col-md-offset-1">
		<h1>Shopping Cart</h1>
	</div>
	

<div class="row">
	<div class="col-md-11 col-md-offset-1">
		<hr />
	</div>
</div>

<div class="col-md-11 col-md-offset-1">
		<table class="table">
			<thead>
				<th>Title</th>
				<th>Quantity</th>
				<th>Price/unit</th>
				<th>Total</th>
				<th></th>
			</thead>
			<tbody>
				@foreach ($items as $item)
							@foreach($cartitems as $cartitem)
							<tr>
								@if($cartitem->item_id == $item->id)
									<td>{{ $item->title }}</td>
									
									{!! Form::model($cartitem, ['route' => ['public.update_cart', $cartitem->id], 'method'=>'PUT', 'data-parsley-validate' => '']) !!}
									
									<td>{{ Form::text('quantity', null, ['class'=>'form-control', 'style'=>'', 
				                                  'data-parsley-required'=>'', 'data-parsley-maxlength'=>'100']) }}</td>
									
									<td> {{ $item->price }}</td>

									<td> {{($item->price)*($cartitem->quantity)}}  </td>
									
									<td style="width: 175px;"><div style='float:left; margin-right:5px;'>
										{{ Form::submit('Update', ['class'=>'btn btn-success btn-sm']) }}
									{!! Form::close() !!}	
									
								</div>
										<div style='float:left;'>
											<div style='float:left; margin-right:5px;'>
												<a href="{{ route('public.remove_item', $cartitem->id) }}" class="btn btn-success btn-sm">Remove</a>
											</div>
										</div>
									</td>
								@endif
								
							</tr>		
							@endforeach
					@endforeach
				</tr>
				<td><h4>Subtotal</h4></td>
				<td>
					@php ($total=0)
					@foreach ($items as $item)
							@foreach($cartitems as $cartitem)
								@if($cartitem->item_id == $item->id)
									@php ($total += $cartitem->quantity*$item->price)
								@endif
							@endforeach
					@endforeach	
					<h4>{{$total}} </h4>
				</td>
			</tr>
			</tbody>
		</table>
		
	</div>

	@endsection