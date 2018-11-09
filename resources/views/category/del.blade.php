@extends('layouts.template')
@section('content')
<div class="alert alert-danger w-100 p-3">
	Deleting category will also delete its products.
</div>
@foreach($categories as $category)
<p class="w-100 p-3">{{ $category->title }} 
	<a href="{{ url('/') }}/categories/del/{{ $category->id }}">Delete</a>
</p>
@endforeach
@endsection