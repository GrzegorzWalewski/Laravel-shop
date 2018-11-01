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
}
