@extends('common') 

@section('pagetitle')
Product List
@endsection

@section('pagename')
Laravel Project
@endsection

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-11 col-md-offset-1">
			<h1>Products</h1>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-md-11 col-md-offset-11">
		
		</div>
	</div>
	<div class="row">
        <div class="col-md-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Categories</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><a href="{{ route('public.show', $category->id) }}">{{ $category->name }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

		<div class="col-md-9">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><a href="{{ route('public.details', $item->id) }}"><img src="{{ Storage::url('images/items/'.'tn_'.$item->picture) }}" alt="{{ $item->title }}" width="100"></a></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->price }}</td>
                            <td><a href="{{ route('public.details', $item->id) }}" class="btn btn-primary">Add to Cart</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection