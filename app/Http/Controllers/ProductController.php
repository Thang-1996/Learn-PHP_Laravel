<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    public function listProduct(){
//            $product = Product::paginate(20);
//        $product = Product::leftjoin("categories","categories.id","=","products.category_id")
//            ->leftjoin("brands","brands.id","=","products.brand_id")
//            ->select("products.*","categories.category_name","brands.brand_name")->paginate(20);
        $product = Product::with("Category")->with("Brand")->paginate(20);
//        dd($product);
        return view("product.list",["products"=>$product]); // string la mang cac product bien duoc gui sang lam bien dau tien cua forech

    }
    public function newProduct(){
        // phai lay du lieu tu cac bang phu
        $category = Category::all();
        $brand = Brand::all();
        return view("product.new",[
                "categories"=>$category,
                "brands" => $brand,
            ]
        );
    }
    public function saveProduct(){ // tạo biến request lưu dữ liệu người dùng gửi lên ở body
        // đầu tiên phải validate dữ liệu cả bên html và bên sever
        // cách validate
        request()->validate([
            "product_name" => "required",
            "product_desc" => "required",
            "price" => "required|numeric|min:0",
            "qty" => "required|numeric|min:1",
            "category_id" => "required",
            "brand_id" => "required",
        ]);
        try {
            // bắt lỗi nếu không có = null
            $productImage = null;
            // xử lý để đưa ảnh lên media trong public sau đó lấy nguồn file cho vào biến $product
            if(request()->hasFile("product_image")){ // nếu request gửi lên có file product_image là inputname
                $file = request()->file("product_image"); // trả về 1 đối tượng lấy từ request của input
                // lấy tên file
                // thêm time() để thay đổi thời gian upload ảnh lên để không bị trùng ảnh với nhau
                $allow = ["png","jpg","jpeg","gif"];
                $extName = $file->getClientOriginalExtension();
                if(in_array($extName,$allow)){ // nếu đuôi file gửi lên nằm trong array
                    $fileName = time().$file->getClientOriginalName(); //  lấy tên gốc original của file gửi lên từ client
                    $file->move(public_path("media"),$fileName); // đẩy file vào thư mục media với tên là fileName
                    //convert string to ProductImage
                    $productImage = "media/".$fileName; // lấy nguồn file
                }
            }
            Product::create([
                "product_name" => request()->get("product_name"),
                "product_image" =>$productImage,
                "product_desc" => request()->get("product_desc"),
                "price" => request()->get("price"),
                "qty" => request()->get("qty"),
                "category_id" => request()->get("category_id"),
                "brand_id" => request()->get("brand_id"),
            ]);
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("admin/list-product");
    }

    public function editProduct($id){
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::findOrFail($id);
        return view("product.edit",[
            "categories"=>$category,
            "brands" => $brand,
            "product" => $product]);
    }
    public function deleteProduct($id){
        $product = Product::findorFail($id);
        try {
            $product->delete();
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("admin/list-product");
    }
    public function updateProduct($id){
        $product = Product::findOrFail($id);
        request()->validate([ // unique voi categories(table) category_name(truong muon unique), (id khong muon bi unique)
            "product_name" => "required|min:3|unique:products,product_name,{$id}",
            "product_desc" => "required",
            "price" => "required|numeric|min:0",
            "qty" => "required|numeric|min:1",
            "category_id" => "required",
            "brand_id" => "required",
        ]);
//            die("pass roi");
        try{
            $productImage = $product->get("product_image");
            // xử lý để đưa ảnh lên media trong public sau đó lấy nguồn file cho vào biến $product
            if(request()->hasFile("product_image")){ // nếu request gửi lên có file product_image là inputname
                $file = request()->file("product_image"); // trả về 1 đối tượng lấy từ request của input
                // lấy tên file
                // thêm time() để thay đổi thời gian upload ảnh lên để không bị trùng ảnh với nhau
                $allow = ["png","jpg","jpeg","gif"];
                $extName = $file->getClientOriginalExtension();
                if(in_array($extName,$allow)){ // nếu đuôi file gửi lên nằm trong array
                    $fileName = time().$file->getClientOriginalName(); //  lấy tên gốc original của file gửi lên từ client
                    $file->move(public_path("media"),$fileName); // đẩy file vào thư mục media với tên là fileName
                    //convert string to ProductImage
                    $productImage = "media/".$fileName; // lấy nguồn file
                }
            }
            $product->update([
                "product_name" => request()->get("product_name"),
                "product_image" => $productImage,
                "product_desc" => request()->get("product_desc"),
                "price" => request()->get("price"),
                "qty" => request()->get("qty"),
                "category_id" => request()->get("category_id"),
                "brand_id" => request()->get("brand_id"),
            ]);
        }catch(Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("admin/list-product");
    }
}
