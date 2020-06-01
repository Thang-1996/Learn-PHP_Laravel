<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";
    public $fillable = [
        "brand_name"
    ];
    public function getImage(){
        if(is_null($this->__get("brand_image"))){
            return asset("media/default.png");
        }
        return asset($this->__get("brand_image"));
    }
}
