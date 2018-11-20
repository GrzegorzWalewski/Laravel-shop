@extends('layouts.template')
@section('content')
<div class="w-100">
    <div class="card mb-10">
        <div class="card-body store-body row">
            <div class="product-info col-12 col-md-6">
              <div class="product-gallery">
                <div class="product-gallery-featured">
                  <img src="{{ url('/') }}/storage/{{ $product->imgName }}" alt="">
                </div>
              </div>
              <div class="product-seller-recommended">
                <div class="product-description mb-5">
                  <h2 class="mb-5">Description</h2>
                  <p>{{ $product->description }}</p>
                </div>
                <div class="product-faq mb-5">
                  <h2 class="mb-3">Rates</h2>
                </div>
                <div class="product-comments">
                    @if($wasBought==1)
                      <h5 class="mb-2">Give Your opionion of product</h5>
                      <form action="{{ url('/') }}/rate/store" class="form-inline mb-5">
                        <input type="text" name="title" placeholder="Title" class="w-75 p-3" required>
                        <textarea name="body" id="" class="form-control w-75 " cols="50" placeholder="Rate" required></textarea>
                        <div class="row lead w-100 p-3">
                            <div id="stars" class="starrr"></div>
                        </div>
                        <input type="hidden" id="starInput" name="rate" required>
                        <input type="hidden" id="id" name="id" value="{{ $product->id }}" required>
                        <button class="btn btn-lg btn-primary ">Rate</button>
                      </form>
                    @endif
                    @if(!empty($product->rate[0]))
                    <h5 class="mb-5">Lastest Rates</h5>
                    <ol class="list-unstyled last-questions-list">
                        @foreach($product->rate as $rate)
                            <li class="rateLi row">
                                @php ($gold = $rate->rate)
                                @php ($grey = 5-$rate->rate)
                                <div class="star-container col-12 mb-4">
                                    @for($i=0; $i<$gold;$i++)
                                        <span class="gold fa fa-star"></span>
                                    @endfor

                                    @for($i=0; $i<$grey;$i++)
                                        <span class=" fa fa-star disable"></span>
                                    @endfor
                                </div>
                                <div class="opinion col-12">
                                    <p class="divider">{{ $rate->title }}</p>
                                    <p>{{ $rate->body }}</p>
                                </div>
                            </li>
                        @endforeach
                    @else
                        No rate yet
                    @endif
                  </ol>
                </div>
              </div>
            </div>
            <div class="product-payment-details col-12 col-md-6">
                @if(Auth::check()&&Auth::user()->isAdmin())
                    <a href="{{ url('/') }}/products/del/{{ $product->id }}">Delete</a>
                    <a href="{{ url('/') }}/products/edit/{{ $product->id }}">Edit</a>
                @endif
              <h4 class="product-title mb-2">{{ $product->title }}</h4>
              <h2 class="product-price display-4">
                @if($product->discount_id!=0&&$product->discount_id!="")
                    @php($newPrice = $product->price-$product->price*($product->discount->body*0.01))
                    {{ $newPrice }}zl
                    <span class="discount_price">{{ $product->price }}zl</span>
                @else
                    {{ $product->price }}zl
                @endif
              </h2>
                @php ($gold = $product->averageRate()['gold'])
                @php ($grey = $product->averageRate()['grey'])
                @if($gold>0)
                    <ul class="rating">
                        @for($i=0; $i<$gold;$i++)
                            <li class="fa fa-star"></li>
                        @endfor
                        @for($i=0; $i<$grey;$i++)
                            <li class="fa fa-star disable"></li>
                        @endfor
                    </ul>
                @endif
              <p class="mb-0"><i class="fa fa-truck"></i> Delivery in all territory</p>
              <label for="quant">Quantity</label>
              <input type="number" name="quantity" min="1" id="quant" class="form-control mb-5 input-lg" placeholder="Choose the quantity" required="">
              <button id="{{ $product->id }}" class="btn btn-primary btn-lg btn-block add-to-cart">Add to cart</button>
              
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/') }}/js/star.js"></script>
<script src="{{ url('/') }}/js/cart.js"></script>
@endsection