@extends('layouts.template')
@section('content')
	@if(!$cart->first())
	<div class="alert alert-dark w-100 p-3">
		You dont have any products in your cart
	</div>
	@else
	<div class="card shopping-cart w-100">
            <div class="card-body">
            		@foreach($cart as $products)
                    <div class="row w-100">
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                        	@php($product = $products->product)
                            <h4 class="product-name"><strong>{{ $product->title }}</strong></h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-6 text-md-right row">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6>@if($product->discount_id!=0&&$product->discount_id!="")
						@php($newPrice = $product->price-$product->price*($product->discount->body*0.01))
					        {{ $newPrice }}zl
					        <span class="discount_price">{{ $product->price }}zl</span>
					    @else
					        {{ $product->price }}zl
					    @endif</h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                    <a class="productAmmount" href="{{ url('/') }}/cart/decrease/{{ $products->id }}">-</a>
                                    <span>{{ $products->pieces }}</span>
                                    <a class="productAmmount" href="{{ url('/') }}/cart/increase/{{ $products->id }}">+</a>
                                </div>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                    <a class="btn btn-outline-danger btn-xs" href="{{ url('/') }}/cart/del/{{ $products->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
            </div>
            
            <div class="card-footer ">
                <div class="float-right" style="margin: 10px">
                    <p class="align-right">Total price: <b>{{ Shop\Cart::sumCart() }}zl</b></p>
                    <a href="{{ url('/') }}/buy" class="btn btn-success pull-right">Checkout</a>
                </div>
            </div>
        </div>


		{{-- <table>
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
		</table> --}}
	@endif
@endsection