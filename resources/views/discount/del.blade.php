@extends('layouts.template')
@section('content')
@foreach($discounts as $discount)
<p class="w-100 p-3">{{ $discount->body }}% 
	<a href="{{ url('/') }}/discounts/del/{{ $discount->id }}">Delete</a>
</p>
@endforeach
@endsection