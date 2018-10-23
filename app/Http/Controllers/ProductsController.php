<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Product;

class ProductsController extends Controller
{
    public function index()
    {
    	$products = Product::latest()->take(12)->get();
    	return view('product.all',compact('products'));
    }
}
