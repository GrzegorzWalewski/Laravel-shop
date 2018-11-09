@extends('layouts.template')

@section('content')
@if(isset($sale))
    <span id="sale"></span>
@endif
@if(isset($category))
    <div class="col-md-12 col-sm-12 text-center">
        <span id="category_id" class="{{ $category->id }}"></span>
        <h1>{{ $category->title }}</h1>
        <hr>
        <p>{{ $category->body }}</p>
        <hr>
    </div>
@endif
@if(!$products->first())
Unfortunately, there are no products.
@endif
@foreach($products as $product)
    <div class="col-md-3 col-sm-6">
        <div class="product-grid">
            <div class="product-image">
                <a href="{{ url('/') }}/{{ $product->id }}">
                    <img class="pic-all" src="{{ asset('storage/') }}/{{ $product->imgName }}">
                </a>
                <ul class="social">
                    @if(Auth::check()&&Auth::user()->isAdmin())
                        <li><a href="{{ url('/') }}/products/del/{{ $product->id }}" data-tip="Delete"><i class="fas fa-trash-alt"></i></a></li>
                    @endif

                    @guest
                        <li><a href="#" data-tip="You have to be logged in"><i class="fa fa-shopping-cart"></i></a></li>
                    @else
                        <li><a href="#" class="add-to-cart" id="{{ $product->id }}" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    @endguest
                </ul>
                @if($product->discount_id!=0&&$product->discount_id!="")
                    <span class="product-new-label">Sale</span>
                    <span class="product-discount-label">{{ $product->discount->body }}%</span>
                @endif
            </div>
                <ul class="rating">
                    @php ($gold = $product->averageRate()['gold'])
                    @php ($grey = $product->averageRate()['grey'])
                    @if($gold>0)
                        @for($i=0; $i<$gold;$i++)
                            <li class="fa fa-star"></li>
                        @endfor

                        @for($i=0; $i<$grey;$i++)
                            <li class="fa fa-star disable"></li>
                        @endfor
                    @else
                        No rate yet
                    @endif
                </ul>
            <div class="product-content">
                <h3 class="title"><a href="{{ url('/') }}/{{ $product->id }}">{{ $product->title }}</a></h3>

                <div class="price">$
                    @if($product->discount_id!=0&&$product->discount_id!="")
                        @php($newPrice = $product->price-$product->price*($product->discount->body*0.01))
                        {{ $newPrice }}
                        <span class="discount_price">${{ $product->price }}</span>
                    @else
                        {{ $product->price }}
                    @endif
                </div>
                @guest
                @else
                    <a class="add-to-cart" id="{{ $product->id }}" href="">+ Add To Cart</a>
                @endguest
            </div>
        </div>
    </div>
@endforeach
@if(isset($load))
    <script src="{{ url('/') }}/js/loadProducts.js"></script>
@endif
<script src="{{ url('/') }}/js/cart.js"></script>
@endsection