<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product()
    {
    	return $this->hasMany(Product::class);
   	}
}
