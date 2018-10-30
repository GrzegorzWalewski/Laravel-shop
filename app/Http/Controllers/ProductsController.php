<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Product;
use Shop\Category;
use Shop\Discount;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
    	$products = Product::latest()->take(12)->get();
    	return view('product.all',compact('products'));
    }

    public function show(Product $product)
    {
    	return view('product.show',compact('product'));
    }

    public function sale()
    {
    	$products = Product::latest()->where('discount_id', '!=' , 0)->get();
    	return view('product.all',compact('products'));
    }
    public function adminPanel()
    {
        return view('admin.all');
    }
    public function create()
    {
        $categories = Category::get();
        $discounts = Discount::get();
        return view('product.create',compact('categories','discounts'));
    }
    public function store()
    {
        $this->validate(request(),[
            'title'       => 'required',
            'description' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'price'       => 'required']);
        if(null!==request('id'))
        {

        }
        else
        {
            Product::Create([
            'title'       => request('title'),
            'description' => request('description'),
            'category_id' => request('category'),
            'discount_id' => request('discount'),
            'price'       => request('price'),
            'imgName'     => "future"]);
            return redirect('/products/add');
        }
    }
}
