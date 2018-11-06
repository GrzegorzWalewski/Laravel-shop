@extends('layouts.template')
@section('content')
	@if(!$cart->first())
	<div class="alert alert-dark w-100 p-3">
		You dont have any products in your cart
	</div>
	@else
		<table>
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
						{{ $products->pieces }}
					</td>
					<td>
						{{ $product->price }}
						<a href="/cart/del/{{ $products->id }}"><i class="fas fa-times"></i></a>
					</td>
				</tr>
				@php($total+=((int)$product->price*(int)$products->pieces))
			@endforeach
			<tr>
				<td>
					Total cost: 
				</td>
				<td>
				</td>
				<td>
					{{ $total }}
				</td>
			</tr>
		</table>
	@endif
@endsection