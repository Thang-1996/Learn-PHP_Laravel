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
      "category_name"
    ];
//    public function get($key){
//        if(is_null($this->__get($key)))
//            return "default";
//        return $this->__get($key);
//
//    }
}
