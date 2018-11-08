<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Category;
use Shop\Product;

class CategorysController extends Controller
{
    public function index(Category $category)
    {
        $products = $category->product;
        $load = true;
    	return view('product.all',compact('category','products','load'));
    }
    public function create()
    {
    	return view('category.create');
    }
    public function store()
    {
    	$this->validate(request(),[
            'title' => 'required',
            'body' 	=> 'required']);
    	$data = Category::Create([
            'title' => request('title'),
            'body' 	=> request('body')]);
        return redirect('/categories/add')->with('data', $data);
    }
    public function show()
    {
    	$categories = Category::get();
    	return view('category.del',compact('categories'));
    }
    public function del(Category $category)
    {
    	$id= $category->id;
    	Product::whereCategoryId($id)->delete();
    	$category->delete();
    	return back();
    }
}
