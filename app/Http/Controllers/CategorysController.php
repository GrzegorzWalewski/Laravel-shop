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
}
