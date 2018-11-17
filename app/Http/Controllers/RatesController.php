<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Rate;

class RatesController extends Controller
{
    public function store()
    {
    	Rate::Create([
    		'product_id' => request('id'),
    		'user_id'	 => auth()->user()->id,
    		'title'		 => request('title'),
    		'body'		 => request('body'),
    		'rate'		 =>request('rate')
    	]);
    	return back();
    }
}
