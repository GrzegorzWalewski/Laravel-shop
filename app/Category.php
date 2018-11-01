<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
        'title', 'body'
    ];
    public function product()
    {
    	return $this->hasMany(Product::class);
   	}
}
