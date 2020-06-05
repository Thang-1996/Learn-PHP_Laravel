<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // khai báo tên bảng
    protected $table = "categories";
    // khóa chính là id thì không cần phải viết lại
    // lọc các trường còn lại của bảng
    public $fillable = [
        "category_name",
        "category_image",
    ];
//    public function get($key){
//        if(is_null($this->__get($key)))
//            return "default";
//        return $this->__get($key);
//
//    }
    public function getImage()
    {
        if (is_null($this->__get("category_image"))) {
            return asset("media/default.png");
        }
        return asset($this->__get("category_image"));
    }

    public function Products()
    {
        return $this->hasMany("\App\Product"); //  trả về 1 collection lấy tất cả sản phẩm thuộc category này
    }

    public function getRouteKeyName()
    {
        return "slug"; // truyen vao route key muon get
    }

    // lay link category
    public function getCategoryUrl()
    {
        return url("/category/{$this->__get("slug")}");
    }
}
