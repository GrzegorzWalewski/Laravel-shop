@extends('layouts.template')
@section('content')

<ul>
	<h1>Add</h1>
	<li><a href="{{ url('/') }}/products/add">Product</a></li>
	<li><a href="{{ url('/') }}/categories/add">Category</a></li>
	<li><a href="{{ url('/') }}/discounts/add">Discount</a></li>
</ul>
@endsection