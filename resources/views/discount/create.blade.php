@extends('layouts.template')
@section('content')
@include('layouts.errors')
@if(session('data'))
	<div class="alert alert-success w-100 p-3">
		Your discount was created successfull
	</div>
@endif
<div class="">
	<h1 class="">Create new disocunt</h1>
	<form method="POST" action="{{ url('/') }}/discounts/store">
		{{ csrf_field() }}

		<input class="form-control" type="text" name="discount" id="discount" placeholder="Discount in %" required>

		<button class="form-control" type="submit">Submit</button>

	</form>
</div>
@endsection