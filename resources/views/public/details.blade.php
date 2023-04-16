@extends('common') 

@section('pagetitle')
Product Details
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')
 
	
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" alt="{{ $item->title }}" width="300">
        </div>
        <div class="col-md-8">
            <h1>{{ $item->title }}</h1>
            <p><strong>Price:</strong> {{ number_format($item->price, 2, '.', ',') }}</p>
            <p><strong>Description:</strong> {{ $item->description }}</p>
            <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
            <p><strong>SKU:</strong> {{ $item->sku }}</p>
				<div style='float:left; margin-right:5px;'>
					  @if($item->quantity > 0)
						<a href="{{ route('public.addToCart', $item->id) }}" class="btn btn-success btn-sm" method="POST"> Buy Now</a>
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection