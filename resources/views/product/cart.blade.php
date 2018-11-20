@extends('layouts.template')
@section('content')
	@if(!$cart->first())
	<div class="alert alert-dark w-100 p-3">
		You dont have any products in your cart
	</div>
	@else
		<table>
			<caption style="caption-side:bottom">
				<a class="" href="{{ url('/') }}/buy">Buy</a>
			</caption>
			<tr>
				<td>Product name: </td>
				<td>Pieces: </td>
				<td>Price: </td>
			</tr>
			@php($total=0)
			@foreach($cart as $products)
				<tr>
					<td>
						@php($product = $products->product)
						{{ $product->title }}
					</td>
					<td>
						<a href="{{ url('/') }}/cart/decrease/{{ $products->id }}">-</a>
						{{ $products->pieces }}
						<a href="{{ url('/') }}/cart/increase/{{ $products->id }}">+</a>
					</td>
					<td>
						@if($product->discount_id!=0&&$product->discount_id!="")
						@php($newPrice = $product->price-$product->price*($product->discount->body*0.01))
					        {{ $newPrice }}zl
					        <span class="discount_price">{{ $product->price }}zl</span>
					    @else
					        {{ $product->price }}zl
					    @endif
						<a href="{{ url('/') }}/cart/del/{{ $products->id }}"><i class="fas fa-times"></i></a>
					</td>
				</tr>
			@endforeach
			<tr>
				<td>
					Total cost: 
				</td>
				<td>
				</td>
				<td>
					{{ Shop\Cart::sumCart() }}zl
				</td>
			</tr>
		</table>
	@endif
@endsection