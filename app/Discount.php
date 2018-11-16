<?php

namespace Shop;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['body'];

    public static function getDetails($id)
    {
        $discount = Discount::where('id',$id)->get();
        return $discount[0];
    }
}
