<?php

namespace Shop\Http\Controllers;

use Illuminate\Http\Request;
use Shop\Discount;
use Shop\Product;

class DiscountsController extends Controller
{
   	public function show()
   	{
   		$discounts = Discount::get();
   		return view('discount.del',compact('discounts'));
   	}
   	public function del(Discount $discount)
   	{
   		$id = $discount->id;
   		Product::whereDiscountId($id)->update(['discount_id' => 0]);
   		$discount->delete();
   		return back();
   	}
   	public function create()
   	{
   		return view('discount.create');
   	}
   	public function store()
   	{
   		if(substr(request('discount'), -1)=="%")
   		{
   			$discount = substr(request('discount'),0, -1);
   		}
   		else
   		{
   			$discount = request('discount');
   		}
   		$data = Discount::Create([
   			'body'	=> $discount]);
   		return redirect('/discounts/add')->with('data', $data);
   	}
}
