<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id','product_id', 'pieces'];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
    static function countWithPieces()
    {
    	$pieces = Cart::get()->where('user_id',auth()->id());
    	$sum = 0;
    	foreach($pieces as $piece)
    	{
    		$sum += $piece->pieces;
    	}
    	return $sum;
    }
}
