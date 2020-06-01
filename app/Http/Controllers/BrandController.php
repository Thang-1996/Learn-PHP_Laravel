<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class BrandController extends Controller
{
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
            // bắt lỗi nếu không có = null
            $brandImage = null;
            // xử lý để đưa ảnh lên media trong public sau đó lấy nguồn file cho vào biến $product
            if($request->hasFile("brand_image")){ // nếu request gửi lên có file product_image là inputname
                $file = $request->file("brand_image"); // trả về 1 đối tượng lấy từ request của input
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
            Brand::create([
                "brand_name" => $request->get("brand_name"),
                "brand_image" =>$brandImage,
            ]);
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("admin/list-brand");
    }
    public function editBrand($id){
        $brand = Brand::findOrFail($id);
        return view("brand.edit",[
            "brand" => $brand]);
    }
    //ham thay doi put du lieu len

    public function updateBrand($id,Request $request){
        $brand = Brand::findOrFail($id);
        $request->validate([ // unique voi categories(table) category_name(truong muon unique), (id khong muon bi unique)
            "brand_name" => "required|min:3|unique:brands,brand_name,{$id}"
        ]);
//            die("pass roi");
        try{
            $brandImage = $brand->get("brand_image");
            // xử lý để đưa ảnh lên media trong public sau đó lấy nguồn file cho vào biến $product
            if($request->hasFile("brand_image")){ // nếu request gửi lên có file product_image là inputname
                $file = $request->file("brand_image"); // trả về 1 đối tượng lấy từ request của input
                // lấy tên file
                // thêm time() để thay đổi thời gian upload ảnh lên để không bị trùng ảnh với nhau
                $allow = ["png","jpg","jpeg","gif"];
                $extName = $file->getClientOriginalExtension();
                if(in_array($extName,$allow)){ // nếu đuôi file gửi lên nằm trong array
                    $fileName = time().$file->getClientOriginalName(); //  lấy tên gốc original của file gửi lên từ client
                    $file->move(public_path("media"),$fileName); // đẩy file vào thư mục media với tên là fileName
                    //convert string to ProductImage
                    $brandImage = "media/".$fileName; // lấy nguồn file
                }
            }
            $brand->update([
                "brand_name" => $request->get("brand_name"),
                "brand_image" => $brandImage,
            ]);
        }catch(Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("adminadmin/list-brand");
    }
    public function deleteBrand($id){
        $brand = Brand::findorFail($id);
        try {
            $brand->delete();
        }catch (\Exception $exception){
            return redirect()->back();
        }
        return redirect()->to("admin/list-brand");
    }
}
