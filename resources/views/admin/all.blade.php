@extends('layouts.template')
@section('content')

<ul>
	<h1>Products</h1>
	<li><a href="{{ url('/') }}/product/add">Add</a></li>
	<li><a href="{{ url('/') }}/product/edit">Edit</a></li>
	<li><a href="{{ url('/') }}/product/del">Delete</a></li>
</ul>

<ul>
	<h1>Categories</h1>
	<li><a href="{{ url('/') }}/categories/add">Add</a></li>
	<li><a href="{{ url('/') }}/categories/edit">Edit</a></li>
	<li><a href="{{ url('/') }}/categories/del">Delete</a></li>
</ul>

<ul>
	<h1>Discounts</h1>
	<li><a href="{{ url('/') }}/discounts/add">Add</a></li>
	<li><a href="{{ url('/') }}/discounts/add">Edit</a></li>
	<li><a href="{{ url('/') }}/discounts/del">Delete</a></li>
</ul>
@endsection