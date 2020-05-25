<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class WebController extends Controller
{
//    public function demoRouting(){
//        return view("demo");
//    }
        public function loginPage(){
            return view("login");
        }
        public function registerPage(){
            return view("registerPage");
        }
        public function forgotpassword(){
            return view("forgotpassword");
        }
        public function index(){
            return view("home");
        }
        public function listCategory(){
            // lấy dữ liệu từ database
            // tạo biến db là tên cột
//            $category = DB::table("categories")->get(); // sử dụng querry buider
//            dd($category);
            // sử dụng ORM
//            $category = Category::all(); // dùng hàm all( lấy tất cả )
            // phan trang trong ngoac la so luong phan tu cua 1 trang
            // simplePaginate la chi co prev or next
//            $category = Category::simplePaginate(20);
//            $category = Category::with("Products")->paginate(20);
            // nếu muốn đếm xem category này có bao nhiêu sản phẩm
            $category = Category::withCount("Products")->paginate(20);
            // show danh sách theo điều kiện
//            $category = Category::where("category_name","LIKE","D%")->get();
//            dd($category); // mỗi phần tử trong array sẽ là 1 đối tượng  của Category
            // cách gửi sang file view truyền vào return thêm 2 tham số
            // tham số đầu tiên là 1 mảng lấy ra từ db và truyền vào biến categories ở trên
            return view("category.list",["categories"=> $category]);
        }
        public function newCategory(){
            return view("category.new");
        }
        public function saveCategory(Request $request){ // tạo biến request lưu dữ liệu người dùng gửi lên ở body
            // đầu tiên phải validate dữ liệu cả bên html và bên sever
            // cách validate
            $request->validate([
               "category_name" => "required|string|min:3|unique:categories"
                // require phải điền kiểu string tối thiếu 6 unique không trùng : categories bảng
            ]);
            try {

                // insert vào bảng
//                DB::table("categories")->insert([
//                    "category_name" => $request->get("category_name"),
//                    "created_at" => Carbon::now(),
//                    "updated_at" => Carbon::now() //  lấy thời gian hiện tại
//                ]);
                // sử dụng orm để insert vào bảng
                Category::create([
                   "category_name" => $request->get("category_name")
                ]); // sẽ trả về một object của Category_Model
            }catch (\Exception $exception){
                return redirect()->back();
            }
            return redirect()->to("/list-category");
        }
    public function listBrand(){
        // lấy dữ liệu từ database
        // tạo biến db là tên cột
//        $brand = DB::table("brands")->get(); // querry buider
        $brand = Brand::paginate(20);
//            dd($category);
        // cách gửi sang file view truyền vào return thêm 2 tham số
        // tham số đầu tiên là 1 mảng lấy ra từ db và truyền vào biến categories ở trên
        return view("brand.list",["brands"=> $brand]);
    }
    public function newBrand(){
        return view("brand.new");
    }
    public function saveBrand(Request $request){ // tạo biến request lưu dữ liệu người dùng gửi lên ở body
        // đầu tiên phải validate dữ liệu cả bên html và bên sever
        // cách validate
        $request->validate([
            "brand_name" => "required|string|min:3|unique:brands"
        ]);
        try {
            Brand::create([
                "brand_name" => $request->get("brand_name")
            ]);
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-category");
    }
    // lay du lieu ve form
    public function editCategory($id){ // id tương đương với querry select truyền vào để hướng tới 1 đối tượng object cụ thể muốn thay đổi
            $category = Category::findOrFail($id); //  cách làm mới tích hợp cả redirect sang trang 404 nếu không tìm thấy
//            // kiểm tra nếu không tìm thấy category có id tương ứng không có
        // cách làm cũ
//            if(is_null($category))
//                abort(404);
//            dd($category);
        return view("category.edit",[
            "category" => $category]);
    }
    public function editBrand($id){
        $brand = Brand::findOrFail($id);
        return view("brand.edit",[
            "brand" => $brand]);
    }
    //ham thay doi put du lieu len
    public function updateCategory($id,Request $request){
            $category = Category::findOrFail($id);
            $request->validate([ // unique voi categories(table) category_name(truong muon unique), (id khong muon bi unique)
               "category_name" => "required|min:3|unique:categories,category_name,{$id}"
            ]);
//            die("pass roi");
        try{
            $category->update([
                "category_name"=> $request->get("category_name")
            ]);
        }catch(Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-category");
    }
    public function updateBrand($id,Request $request){
        $brand = Brand::findOrFail($id);
        $request->validate([ // unique voi categories(table) category_name(truong muon unique), (id khong muon bi unique)
            "brand_name" => "required|min:3|unique:brands,brand_name,{$id}"
        ]);
//            die("pass roi");
        try{
            $brand->update([
                "brand_name"=> $request->get("brand_name")
            ]);
        }catch(Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-brand");
    }
    // ham delete
    public function deleteCategory($id){
            $category = Category::findorFail($id);
        try {
            $category->delete();
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-category");
    }
    public function deleteBrand($id){
        $brand = Brand::findorFail($id);
        try {
            $brand->delete();
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-brand");
    }
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
    public function saveProduct(Request $request){ // tạo biến request lưu dữ liệu người dùng gửi lên ở body
        // đầu tiên phải validate dữ liệu cả bên html và bên sever
        // cách validate
        $request->validate([
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
            if($request->hasFile("product_image")){ // nếu request gửi lên có file product_image là inputname
                $file = $request->file("product_image"); // trả về 1 đối tượng lấy từ request của input
                // lấy tên file
                // thêm time() để thay đổi thời gian upload ảnh lên để không bị trùng ảnh với nhau
                $fileName = time().$file->getClientOriginalName(); //  lấy tên gốc original của file gửi lên từ client
                $file->move(public_path("media"),$fileName); // đẩy file vào thư mục media với tên là fileName
                //convert string to ProductImage
                $productImage = "media/".$fileName; // lấy nguồn file
            }
            Product::create([
                "product_name" => $request->get("product_name"),
                "product_image" =>$productImage,
                "product_desc" => $request->get("product_desc"),
                "price" => $request->get("price"),
                "qty" => $request->get("qty"),
                "category_id" => $request->get("category_id"),
                "brand_id" => $request->get("brand_id"),
            ]);
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-product");
    }
    public function deleteProduct($id){
        $product = Product::findorFail($id);
        try {
            $product->delete();
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-product");
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
    public function updateProduct($id,Request $request){
        $product = Product::findOrFail($id);
        $request->validate([ // unique voi categories(table) category_name(truong muon unique), (id khong muon bi unique)
            "product_name" => "required|min:3|unique:products,product_name,{$id}"
        ]);
//            die("pass roi");
        try{
            $product->update([
                 "product_name" => $request->get("product_name"),
                "product_desc" => $request->get("product_desc"),
                "price" => $request->get("price"),
                "qty" => $request->get("qty"),
                "category_id" => $request->get("category_id"),
                "brand_id" => $request->get("brand_id"),
            ]);
        }catch(Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-product");
    }
}

