<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    // khóa chính là id thì không cần phải viết lại
    // lọc các trường còn lại của bảng
    public $fillable = [
        "product_name",
        "product_image",
        "product_desc",
        "price",
        "qty",
        "category_id",
        "brand_id",
    ];
    public function getImage(){
        if(is_null($this->__get("product_image"))){
            return asset("media/default.png");
        }
        return asset($this->__get("product_image"));
    }
    // moi quan he anh xa sang categories
    public function Category(){
        return $this->belongsTo("\App\Category","category_id"); //  se co quan he 1-1 voi category //  trả về 1 object
    }
    public function Brand(){
        return $this->belongsTo("\App\Brand","brand_id"); //  se co quan he 1-1 voi brand
    }
}
