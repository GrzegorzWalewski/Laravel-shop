<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function rate()
    {
    	return $this->HasMany(Rate::class);
    }
    public function discount()
    {
    	return $this->belongsTo(Discount::class);
    }
    public function averageRate()
    {
    	$rate = $this->HasMany(Rate::class);
    	$averageRate = $rate->avg('rate');
    	
    	return $rate = [
    		"gold" => $averageRate,
    		"grey" => 5-$averageRate];
    }
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
