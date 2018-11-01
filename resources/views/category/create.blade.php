@extends('layouts.template')
@section('content')
@include('layouts.errors')
@if(session('data'))
	<div class="alert alert-success w-100 p-3">
		Your category was created successfull
	</div>
@endif
<div class="">
	<h1 class="">Create new category</h1>
	<form method="POST" action="{{ url('/') }}/categories/store">
		{{ csrf_field() }}

		<input class="form-control" type="text" name="title" id="title" placeholder="Title" required>

		<textarea class="form-control" name="body" id="body" placeholder="Description" required></textarea>

		<button class="form-control" type="submit">Submit</button>

	</form>
</div>
@endsection