<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    protected $fillable = ['user_id','product_id', 'pieces', 'price'];

    public static function wasBought($id)
    {
    	$result = Bought::where('product_id', $id)->where('user_id',auth()->user()->id)->count();
    	if($result!=0)
    	{
    		return true;
    	}
    	else
    	{
    		return "";
    	}
    }
}
