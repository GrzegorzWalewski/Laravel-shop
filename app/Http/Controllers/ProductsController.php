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
        $load = true;
    	return view('product.all',compact('products','load'));
    }

    public function show(Product $product)
    {
    	return view('product.show',compact('product'));
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
        $path = $request->file('img')->store('public/products');
        $path = str_replace('public/',"",$path);
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
        $product->delete();
        return redirect('/');
    }
    public function load()
    {
        $from = request('from');
        $category_id = request('category');
        $count = 4;
        $sale = request('sale');
        if($category_id!="")
        {
            if($sale == "true")
            {
                $products = Product::latest()->take($count)->where('id','>=',$from)->where('category_id',$category_id)->where('discount_id','>',0)->get();
            }
            else
            {
                $products = Product::latest()->take($count)->where('id','>=',$from)->where('category_id',$category_id)->get();
            }
        }
        else
        {
            if($sale == "true")
            {
                $products = Product::latest()->take($count)->where('id','>=',$from)->where('discount_id','>',0)->get();
            }
            else
            {
                $products = Product::latest()->take($count)->where('id','>=',$from)->get();
            }
        }
        return view('product.ajax', compact('products'));
    }
    public function search()
    {
        $search=request('search');
        $products = Product::latest()->where('title','like','%'.$search."%")->get();
        return view('product.all',compact('products'));
    }
}
