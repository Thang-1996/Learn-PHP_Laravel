<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function Sodium\increment;

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
        // auto add category slug
//        $categorys = Category::all();
//        foreach ($categorys as $category){
//            $slug = Str::slug($category->__get("category_name"));
//            $category->slug = $slug.$category->__get("id");
//            $category->save();
//        }
//        die("done");
        // lấy ra những sản phẩm nhiều người xem
        $most_viewer = Product::orderBy("view_count","DESC")->limit(8)->get();
        $features = Product::orderBy("updated_at","DESC")->limit(8)->get();
        $laster1 = Product::orderBy("updated_at","DESC")->limit(2)->get(); // lấy đầu tiên
        $laster2 = Product::orderBy("updated_at","DESC")->offset(2)->limit(2)->get(); // lấy đầu tiên
        // offset la bo di so luog
        return view('frontend.home',[
            "most_viewer" => $most_viewer,
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
        // đếm số lượng sản phẩm xem được
        if(!session()->has("view_count_{$product->__get("id")}")){// kiểm tra xem sesion  nếu chưa có sẽ đăng lên
            $product->increment("view_count");     // tự tăng lên 1 mỗi lần user ấn vào xem sản phẩm
            session(["view_count{$product->__get("id")} => true"]);// lấy session ra 1 session sẽ có giá trị lưu giữ trong vòng 2 tiếng
        }

//        $product = Product::where("category_id",$category->__get("id"))->paginate(12);
        $relativeProduct= Product::with("Category")->paginate(4);
        return view("frontend.product",[
            "product" => $product,
            "relativeProducts" => $relativeProduct,
        ]);
    }
    public function addToCart(Product $product,Request $request){
        $qty = $request->has("qty") && (int)$request->get("qty")>0?(int)$request->get("qty"):1;// kiểm tra qty co phai number hay khong
       // lay qty kiem tra neu la int > 0 thi se tra ve = qty = 1
        $myCart = session()->has("my_cart") && is_array(session("my_cart"))?session("my_cart"):[];
        // kiem tra session neu co truong my_cart va mang my_cart neu khong co se truyen vao 1 mang rong~
        // nguyen tac lam trang gio hang se tang so luong chu khong tang san pham vao
        $content = false; // dat 1 bien de kiem tra trang thai san pham co hay chua
        foreach ($myCart as $item){
            if($item["product_id"] == $product->__get("id")){ // nếu sản phẩm đã có trong giỏ
                $item["qty"]+=$qty; // nếu có thì sẽ truyền thêm vào biến qty ở trên
                $content = true; // neu co san pham se truyen trang thai ve true
                break;
            }

        }
        if(!$content){ // nếu trả về true sẽ trả về 1 mảng mycart mới truyền vào qty và id sản phẩm hiện tại
            $myCart[] = [
                "product_id" => $product->__get("id"),
                "qty" => $qty
            ];
        }
//        dd($myCart);
        // nap lai session cũ
        session(["my_cart" => $myCart]);
        // return redirect về trang trước
        return redirect()->back();
    }
    public function shoppingCart(){
        $myCart = session()->has("my_cart") && is_array(session("my_cart"))?session("my_cart"):[];
        $products = [];
        foreach ($myCart as $item){
            $products[] = $item["product_id"];
        }
        $grandTotal = 0;
        $products = \App\Product::find($products);
        foreach ($products as $p){
            foreach ($myCart as $item){
                if($p->__get("id") == $item["product_id"]){
                    $grandTotal += ($p->__get("price") * $item["qty"]);
                    $p->cart_qty = $item["qty"]; // them doi tuong cart_qty de foreach ra mang
                }
            }
        }
        return view("frontend.cart",[
            "products" => $products,
            "grandTotal" => $grandTotal,
        ]);
    }
    public function checkOut(){

    }
}
