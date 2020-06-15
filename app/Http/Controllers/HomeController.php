<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Events\OrderCreated;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function GuzzleHttp\Psr7\_caseless_remove;
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
        // kiểm tra cache
        if(!Cache::has("home_page")){ // nếu chưa có sẽ lưu các câu truy vấn sql vào cache theo 1 nhãn tên là homepage
            $most_viewer = Product::orderBy("view_count", "DESC")->limit(8)->get();
            $features = Product::orderBy("updated_at", "DESC")->limit(8)->get();
            $laster1 = Product::orderBy("updated_at", "DESC")->limit(2)->get(); // lấy đầu tiên
            $laster2 = Product::orderBy("updated_at", "DESC")->offset(2)->limit(2)->get(); // lấy đầu tiên
             // tương tự lớp date/time
            // nạp cho vào cache trong vòng 20 phút sau 20 phút sẽ xóa đi và tạo lại
            $view = view ('frontend.home', [
                "most_viewer" => $most_viewer,
                "features" => $features,
                "laster1" => $laster1,
                "laster2" => $laster2,
            ])->render();
            $now = Carbon::now();
            Cache::put("home_page",$view,$now->addMinute(20));
        }
        return Cache::get("home_page");
        // offset la bo di so luog

    }
    public function category(Category $category)
    {
//        $product = Product::where("category_id",$category->__get("id"))->paginate(12);
        $product = $category->Products()->simplePaginate(12); // dung ham trong model product de lay tat ca
        return view("frontend.category", [
            "category" => $category,
            "products" => $product,
        ]);
    }

    public function product(Product $product)
    {
        // đếm số lượng sản phẩm xem được
        if (!session()->has("view_count_{$product->__get("id")}")) {// kiểm tra xem sesion  nếu chưa có sẽ đăng lên
            $product->increment("view_count");     // tự tăng lên 1 mỗi lần user ấn vào xem sản phẩm
            session(["view_count{$product->__get("id")} => true"]);// lấy session ra 1 session sẽ có giá trị lưu giữ trong vòng 2 tiếng
        }

//        $product = Product::where("category_id",$category->__get("id"))->paginate(12);
        $relativeProduct = Product::with("Category")->paginate(4);
        return view("frontend.product", [
            "product" => $product,
            "relativeProducts" => $relativeProduct,
        ]);
    }

    public function addToCart(Product $product, Request $request)
    {
        $qty = $request->has("qty") && (int)$request
            ->get("qty") > 0 ? (int)$request
            ->get("qty") : 1;// kiểm tra qty co phai number hay khong
//        dd($qty);
        // lay qty kiem tra neu la int > 0 thi se tra ve = qty = 1
        $myCart = session()->has("my_cart") && is_array(session("my_cart")) ? session("my_cart") : [];
//        dd($myCart);
        // kiem tra session neu co truong my_cart va mang my_cart neu khong co se truyen vao 1 mang rong~
        // nguyen tac lam trang gio hang se tang so luong chu khong tang san pham vao
        if (Auth::check()) {
            if (Cart::where("user_id", Auth::id())
                ->where("is_checkout", true)->exists()) {
                $cart = Cart::where("user_id", Auth::id())
                    ->where("is_checkout", true)->first();
            } else {
                $cart = Cart::create([
                    "user_id" => Auth::id(),
                    "is_checkout" => true

                ]);
            }
        }
        $contain = false;
        foreach ($myCart as $key => $item) { // dua vao key de lay lai doi tuong item
            if ($item["product_id"] == $product->__get("id")) { // nếu sản phẩm đã có trong giỏ
                $myCart[$key]["qty"] += $qty; // nếu có thì sẽ truyền thêm vào biến qty ở trên
                $contain = true; // neu co san pham se truyen trang thai ve true
                if (Auth::check()) {
                    DB::table("cart_product")
                        ->where("cart_id", $cart->__get("id"))
                        ->where("product_id", $item["product_id"])
                        ->update([
                            "qty" => $myCart[$key]["qty"]
                        ]);
                }
                break;
            }
        }
        // dat 1 bien de kiem tra trang thai san pham co hay chua
        if (!$contain) { // nếu trả về true sẽ trả về 1 mảng mycart mới truyền vào qty và id sản phẩm hiện tại
            $myCart[] = [
                "product_id" => $product->__get("id"),
                "qty" => $qty
            ];
            DB::table("cart_product")->insert([
                "qty" => $qty,
                "cart_id" => $cart->__get("id"),
                "product_id" => $product->__get("id")
            ]);
        }
//        dd($myCart);
        // nap lai session cũ
        session(["my_cart" => $myCart]);
        // them sản phẩm từ giỏ hàng vào database
        // cart chinh la doi tuong cart vua tao ra va se them lai vao bang trung gian
        // return redirect về trang trước
        return redirect()->back();
    }

    public function shoppingCart()
    {
        $myCart = session()->has("my_cart") && is_array(session("my_cart")) ? session("my_cart") : [];
        $products = [];
        foreach ($myCart as $item) {
            $products[] = $item["product_id"];
        }
        $grandTotal = 0;
        $products = \App\Product::find($products);
        foreach ($products as $p) {
            foreach ($myCart as $item) {
                if ($p->__get("id") == $item["product_id"]) {
                    $grandTotal += ($p->__get("price") * $item["qty"]);
                    $p->cart_qty = $item["qty"]; // them doi tuong cart_qty de foreach ra mang
                }
            }
        }
        return view("frontend.cart", [
            "products" => $products,
            "grandTotal" => $grandTotal,
        ]);
    }

    public function checkOut()
    {
        // lấy thông tin từ giỏ hàng ra
        $cart = Cart::where("user_id", Auth::id())
            ->where("is_checkout", true)
            ->with("getItems")
            ->firstOrFail();
        return view("frontend.checkout", [
            "cart" => $cart
        ]);
    }
    public function placeOrder(Request $request){
        $request->validate([
           "user_name" => "required",
           "address" => "required",
           "telephone" => "required",
        ]);
        $cart = Cart::where("user_id", Auth::id())
            ->where("is_checkout", true)
            ->with("getItems")
            ->firstOrFail();
        $grandTotal = 0;
        foreach ($cart->getItems as $item){
            $grandTotal+=$item->pivot->__get("qty")*$item->__get("price");
        }
        try{
            $order = Order::create([
               "user_id" => Auth::id(),
               "user_name" => $request->get("user_name"),
                "address" => $request->get("address"),
                "telephone" => $request->get("telephone"),
                "note" => $request->get("note"),
                "grand_total" => $grandTotal,
                "status" => Order::PENDING
            ]);
            foreach ($cart->getItems as $item){
                DB::table("orders_products")->insert([
                   "order_id" => $order->__get("id"),
                    "product_id" => $item->__get("id"),
                    "price" => $item->__get("price"),
                    "qty" => $item->pivot->__get("qty"),
                ]);
            }
            // phát ra sự kiện dùng biến order để sử dụng
            event(new OrderCreated($order));
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }

}
