@extends('layouts.template')

@section('content')
@foreach($products as $product)
<div class="col-md-3 col-sm-6">
    <div class="product-grid">
        <div class="product-image">
            <a href="#">
                <img class="pic-1" src="">
                <img class="pic-1" src="http://bestjquery.com/tutorial/product-grid/demo9/images/img-1.jpg">
                </a>
                <ul class="social">
                    <li><a href="" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                    <li><a href="" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                    <li><a href="" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
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
                    <h3 class="title"><a href="#">{{ $product->title }}</a></h3>
                    <div class="price">${{ $product->price }}
                        @if($product->discount_id!=0&&$product->discount_id!="")
                        <span>$20.00</span>
                        @endif
                    </div>
                    <a class="add-to-cart" href="">+ Add To Cart</a>
                </div>
            </div>
</div>
@endforeach
@endsection