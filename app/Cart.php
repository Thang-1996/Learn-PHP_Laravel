<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    public $fillable = [
        "user_id",
        "is_checkout",
    ];

    // lay tat ca nhung san pham thuoc gio hang
    public function getItems()
    { // withpivot la doi tuong trung gian cac truong muon lay them
        return $this->belongsToMany("\App\Product", "cart_product")->withPivot(["qty"]);
    }
}
