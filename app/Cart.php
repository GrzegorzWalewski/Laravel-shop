<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id','product_id', 'pieces', 'price'];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    public static function countWithPieces()
    {
    	$pieces = Cart::get()->where('user_id',auth()->id());
    	$sum = 0;
    	foreach($pieces as $piece)
    	{
    		$sum += $piece->pieces;
    	}
    	return $sum;
    }
    public static function count()
    {
        return Cart::get()->where('user_id',auth()->id())->count();
    }
    static function sumCart()
    {
        $carts = Cart::get()->where('user_id',auth()->id());
        $sum = 0;
        foreach($carts as $cart)
        {
            $sum += $cart->pieces*$cart->price;
        }
        return $sum;
    }
}
