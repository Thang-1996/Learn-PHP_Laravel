<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            // show danh sách theo điều kiện
            $category = Category::where("category_name","LIKE","D%")->get();
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
        $brand = DB::table("brands")->get(); // querry buider
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
            // require phải điền kiểu string tối thiếu 6 unique không trùng : categories bảng
        ]);
        try {

            // insert vào bảng
            DB::table("brands")->insert([
                "brand_name" => $request->get("brand_name"),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now() //  lấy thời gian hiện tại
            ]);
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("/list-brand");
    }
}
