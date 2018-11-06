<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Cart;

class CartsController extends Controller
{
    public function store()
    {
    	if(Cart::where('user_id',auth()->id())->where('product_id',request('id'))->count()>0)
    	{
    		Cart::where('user_id',auth()->id())->where('product_id',request('id'))->increment('pieces');
    	}
    	else
    	{
	    	$product_id = request('id');
	    	Cart::Create([
	    		'user_id' 	 => auth()->id(),
	    		'product_id' => $product_id,
	    		'pieces'	 => 1
	    		]);
    	}
    	return Cart::countWithPieces();
    }
    public function show()
    {
    	$cart = Cart::latest()->get();
    	return view('product.cart',compact('cart'));
    }
    public function del(Cart $cart)
    {
    	if($cart->pieces==1)
    	{
    		$cart->delete();
    	}
    	else
    	{
    		$pieces = $cart->pieces;
    		$cart->update(['pieces' => $pieces-1]);
    	}
    	return back();
    }
}
