<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Product;
use Shop\Category;
use Shop\Discount;
use Illuminate\Support\Facades\Auth;
use Shop\User;
use Shop\Bought;
use Shop\Rate;
use Shop\Cart;
class ProductsController extends Controller
{
    public function index()
    {
    	$products = Product::latest()->take(12)->get();
        $load = true;
    	return view('product.all',compact('products','load'));
    }

    public function show(Product $product)
    {
        $wasBought = Bought::wasBought($product->id);
    	return view('product.show',compact('product','wasBought'));
    }

    public function sale()
    {
    	$products = Product::take(12)->where('discount_id', '!=' , 0)->get();
        $sale = true;
        $load = true;
    	return view('product.all',compact('products','sale','load'));
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
    public function edit(Product $product)
    {
        $categories = Category::get();
        $discounts = Discount::get();
        return view('product.edit',compact('categories','discounts','product'));
    }
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title'       => 'required',
            'description' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'price'       => 'required']);
        if(null!==request('id'))
        {
            Product::where('id',request('id'))
            ->update([
            'title'       => request('title'),
            'description' => request('description'),
            'category_id' => request('category'),
            'discount_id' => request('discount'),
            'price'       => request('price')
            ]);
            $url = url('/')."/products/edit/".request('id');
            return redirect($url)->with('id',request('id'));
        }
        else
        {
            $path = $request->file('img')->store('public/products');
            $path = str_replace('public/',"",$path);
            $data = Product::Create([
            'title'       => request('title'),
            'description' => request('description'),
            'category_id' => request('category'),
            'discount_id' => request('discount'),
            'price'       => request('price'),
            'imgName'     => $path]);
            $id = $data->id;
            return redirect('/products/add')->with('id', $id);
        }
    }
    public function del(Product $product)
    {
        Rate::where('product_id',$product->id)->delete();
        Cart::where('product_id',$product->id)->delete();
        $product->delete();
        return redirect('/');
    }
    public function load()
    {
        $from = request('from');
        $category_id = request('category');
        $search = request('searchQuote');
        $count = 4;
        $sale = request('sale');
        if(Product::count()>=$count)
        {
            if($category_id!="")
            {
                if($sale == "true")
                {
                    $products = Product::where('title','like','%'.$search."%")->skip($from)->take($count)->where('category_id',$category_id)->where('discount_id','>',0)->get();
                }
                else
                {
                    $products = Product::where('title','like','%'.$search."%")->skip($from)->take($count)->where('category_id',$category_id)->get();
                }
            }
            else
            {
                if($sale == "true")
                {
                    $products = Product::where('title','like','%'.$search."%")->skip($from)->take($count)->where('discount_id','>',0)->get();
                }
                else
                {
                    $products = Product::where('title','like','%'.$search."%")->skip($from)->take($count)->get();
                }
            }
            return view('product.ajax', compact('products'));
        }
        
    }
    public function search()
    {
        $search=request('search');
        $products = Product::take(12)->where('title','like','%'.$search."%")->get();
        $load = true;
        return view('product.all',compact('products','search','load'));
    }
}
