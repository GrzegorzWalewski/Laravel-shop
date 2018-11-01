@extends('layouts.template')
@section('content')
@include('layouts.errors')
@if(session('id'))
	<div class="alert alert-success w-100 p-3">
		Your post was edited successfull. You can see it <a href="{{ url('/') }}/{{ session('id') }}">here</a>
	</div>
@endif
<div class="">
	<h1 class="">Edit post</h1>
	<form method="POST" action="{{ url('/') }}/products/store">
		{{ csrf_field() }}

		<input class="form-control" type="hidden" name="id" id="id" value="{{ $product->id }}" required>

		<input class="form-control" type="text" name="title" id="title" placeholder="Title" value="{{ $product->title }}" required>

		<textarea class="form-control" name="description" id="description" placeholder="Description" required>{{ $product->description }}</textarea>

		<select class="form-control" name="category">
			@foreach($categories as $category)
				<option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->title }}</option>
			@endforeach
		</select>

		<select class="form-control" name="discount">
				<option value="0">None</option>
			@foreach($discounts as $discount)
				<option value="{{ $discount->id }}" @if($discount->id == $product->discount_id) selected @endif>{{ $discount->body }}%</option>
			@endforeach
		</select>
		
		<input class="form-control" type="text" name="price" id="price" placeholder="Price" value="{{ $product->price }}" required>

		<button class="form-control" type="submit">Submit</button>

	</form>
</div>
@endsection