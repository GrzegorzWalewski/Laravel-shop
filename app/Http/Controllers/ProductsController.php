<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
    	return view('layouts.template');
    }
}
