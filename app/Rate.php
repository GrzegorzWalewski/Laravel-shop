<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['body','title','user_id','product_id','rate'];
}
