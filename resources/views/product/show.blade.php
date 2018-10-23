@extends('layouts.template')
@section('content')

<div class="col-md-6 col-sm-6 product_picture">
	<img class="pic-1" src="http://bestjquery.com/tutorial/product-grid/demo9/images/img-1.jpg">
</div>

<div class="col-md-5 col-sm-6 text-right">

	<h1 class="text-center">{{ $product->title }}</h1>
    <p>Category: <a href="{{ url('/') }}/category/{{ $product->category->id }}">{{ $product->category->title }}</a></p>
	<div class="price">Price: $
    @if($product->discount_id!=0&&$product->discount_id!="")
	@php($newPrice = $product->price-$product->price*($product->discount->body*0.01))

        {{ $newPrice }}
        <span class="discount_price">${{ $product->price }}</span>
    @else
        {{ $product->price }}
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
    <div class="description">
    	<h2>About:</h2>
    	<p>{{ $product->description }}</p>
    </div>
    <div class="rate">
    	@if(!empty($product->rate[0]))
    		Few recent rates:
	    	@foreach($product->rate as $rate)
		    	<hr>
		    	{{ $rate->title }} 
		    	@php ($gold = $rate->rate)
		        @php ($grey = 5-$rate->rate)
		        <div class="rating">
		        	@for($i=0; $i<$gold;$i++)
		                <li class="fa fa-star"></li>
		        	@endfor

		        	@for($i=0; $i<$grey;$i++)
		                <li class="fa fa-star disable"></li>
		        	@endfor
		    	</div>
		   	@endforeach
        @else
            No rate yet
        @endif
    </div>
</div>


@endsection