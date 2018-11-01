<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Category;

class CategorysController extends Controller
{
    public function index(Category $category)
    {
    	return view('category.show',compact('category'));
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
