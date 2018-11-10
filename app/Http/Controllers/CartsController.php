<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Cart;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function store()
    {
    	if(Cart::where('user_id',Auth::user()->id)->where('product_id',request('id'))->count()>0)
    	{
    		Cart::where('user_id',Auth::user()->id)->where('product_id',request('id'))->increment('pieces');
    	}
    	else
    	{
	    	$product_id = request('id');
	    	Cart::Create([
	    		'user_id' 	 => Auth::user()->id,
	    		'product_id' => $product_id,
	    		'pieces'	 => 1
	    		]);
    	}
    	return Cart::countWithPieces();
    }
    public function show()
    {
    	$cart = Cart::latest()->where('user_id',Auth::user()->id)->get();
    	return view('product.cart',compact('cart'));
    }
    public function del(Cart $cart)
    {
    	$cart->delete();
    	return back();
    }
    public function increase(Cart $cart)
    {
        $pieces = $cart->pieces;
        $cart->update(['pieces' => $pieces+1]);
        return back();
    }
    public function decrease(Cart $cart)
    {
        $pieces = $cart->pieces;
        if($pieces == 1)
        {
            $cart->delete();
        }
        else
        {
            $cart->update(['pieces' => $pieces-1]);
        }
        return back();
    }
}
