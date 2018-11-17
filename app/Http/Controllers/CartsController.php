<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Cart;
use Illuminate\Support\Facades\Auth;
use Shop\Product;
use Shop\Bought;

class CartsController extends Controller
{
    public function store()
    {
        if(request('quantity')>1)
        {
            $i = request('quantity');
        }
        else
        {
            $i = 1;
        }
        for($i;$i>0;$i--)
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
                    'price'      => Product::getDetails($product_id)->price,
    	    		'pieces'	 => 1
    	    		]);
        	}
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
    public function submit()
    {
        $cart = Cart::latest()->where('user_id',Auth::user()->id)->get();
        $products = [];
        $i = 0;
        foreach($cart as $product)
        {
            $products[$i] = Product::getDetails($product->product_id);
            $i++;
        }
        $price = Cart::sumCart();
        $description = "";
        $i = 0;
        foreach($cart as $product)
        {
            if($description == "")
            {
                $description = $description.$products[$i]->title." x ".$product->pieces; 
            }
            else
            {
                $description = $description.", ".$products[$i]->title." x ".$product->pieces; 
            }
            
            $i++;
        }
        $paymentDetails= [
            'pin'         => 'dgdGtRbkYlEzs3GX5txsiXe4564vBTsC',
            'api_version' => 'dev',
            'id'          => '759128',
            'description' => $description,
            'amount'      => $price,
            'currency'    => 'PLN',
            'url'         => url('/')."/success",
            'type'        => 0,
            'buttontext'  => "Go back to Laravel-shop",
            'email'       => "grzojda@gmail.com",
            'p_email'     => Auth::user()->email
        ];
        $chk = $paymentDetails['pin'].$paymentDetails['api_version'].$paymentDetails['id'].$paymentDetails['amount'].$paymentDetails['currency'].$paymentDetails['description'].$paymentDetails['url'].$paymentDetails['type'].$paymentDetails['buttontext'].$paymentDetails['email'].$paymentDetails['p_email'];
        $ChkValue = hash('sha256',$chk);
        return view('product.submit', compact('paymentDetails','ChkValue'));
    }
    public function success()
    {
        if(request('status')=="OK")
        {
            $carts = Cart::where('user_id',Auth::user()->id)->get();
            foreach ($carts as $cart) 
            {
                Bought::Create([
                    'user_id'    => $cart->user_id,
                    'product_id' => $cart->product_id,
                    'price'      => $cart->price,
                    'pieces'     => $cart->pieces
                ]);
            }
            Cart::where('user_id',Auth::user()->id)->delete();
        }
        return redirect('/');
    }
}