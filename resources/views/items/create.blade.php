@extends('common') 

@section('pagetitle')
Create Item
@endsection

@section('pagename')
Laravel Project
@endsection

@section('scripts')
    
    <script src="https://cdn.tiny.cloud/1/7iw4raxczr993nsih761ham4xalj32p9r0k0uu2p8bnjlm5s/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function(){
            $('#description').on('change', function(){
                $('#description').parsley().validate();
            });
            tinymce.init({
                selector: '#description',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',
                height: 400,
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                        $('#description').parsley().validate();
                    });
                }
            });
        });
    </script> 
@endsection
@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Add New Item</h1>
			<hr/>

			{!! Form::open(['route' => 'items.store', 'data-parsley-validate' => '', 
			                'files' => true]) !!}
			    
				{{ Form::label('title', 'Name:') }}
			    {{ Form::text('title', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'', 
											  'data-parsley-maxlength'=>'255']) }}

				{{ Form::label('category_id', 'Category:', ['style'=>'margin-top:20px']) }}
				<select name='category_id' class='form-control' data-parsley-required="true">
					<option value="">Select Category</option>
					@foreach ($categories as $category)
						<option value='{{ $category->id }}'>{{ $category->name }}</option>
					@endforeach
				</select>

			    {{ Form::label('description', 'Description:', ['style'=>'margin-top:20px']) }}
			    {{ Form::textarea('description', null, ['class'=>'form-control', 
				                                 'data-parsley-required'=>'']) }}

				{{ Form::label('price', 'Price:', ['style'=>'margin-top:20px']) }}
			    {{ Form::text('price', null, ['class'=>'form-control', 'style'=>'', 
			                                  'data-parsley-required'=>'']) }}

				{{ Form::label('quantity', 'Quantity:', ['style'=>'margin-top:20px']) }}
			    {{ Form::text('quantity', null, ['class'=>'form-control', 'style'=>'', 
											  'data-parsley-required'=>'']) }}
											  
				{{ Form::label('sku', 'SKU:', ['style'=>'margin-top:20px']) }}
			    {{ Form::text('sku', null, ['class'=>'form-control', 'style'=>'', 
											  'data-parsley-required'=>'']) }}
											  
				{{ Form::label('picture', 'Picture:', ['style'=>'margin-top:20px']) }}
			    {{ Form::file('picture', null, ['class'=>'form-control', 
				                                       'style'=>'',
													   'data-parsley-required'=>'']) }}

			    {{ Form::submit('Create Item', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px']) }}

			{!! Form::close() !!}

		</div>
	</div>

@endsection