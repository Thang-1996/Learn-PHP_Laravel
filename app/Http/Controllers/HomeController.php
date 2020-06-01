<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        $products = Product::all();
//        foreach ($products as $product){
//            $slug = Str::slug($product->__get("product_name"));
//            $product->slug = $slug.$product->__get("id");
//            $product->save();
//        }
//        die("done");
        $features = Product::orderBy("updated_at","DESC")->limit(8)->get();
        $laster1 = Product::orderBy("updated_at","DESC")->limit(2)->get(); // lấy đầu tiên
        $laster2 = Product::orderBy("updated_at","DESC")->offset(2)->limit(2)->get(); // lấy đầu tiên
        // offset la bo di so luog
        return view('frontend.home',[
            "features" => $features,
            "laster1" => $laster1,
            "laster2" => $laster2,
        ]);
    }
    public function category(Category $category){
//        $product = Product::where("category_id",$category->__get("id"))->paginate(12);
        $product = $category->Products()->simplePaginate(12); // dung ham trong model product de lay tat ca
        return view("frontend.category",[
            "category" => $category,
            "products" => $product,
        ]);
    }
    public function product(Product $product){
//        $product = Product::where("category_id",$category->__get("id"))->paginate(12);
        $relativeProduct= Product::with("Category")->paginate(4);
        return view("frontend.product",[
            "product" => $product,
            "relativeProducts" => $relativeProduct,
        ]);
    }
}
