<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Authencation


Auth::routes();
require_once "user.php";
// tạo thêm router mới sau / l
//à đường dẫn đến routing  // goi duong dan duong file controller ma khong can phai viet ham ham se duoc viet o controller
//Route::get("/login","WebController@loginPage"); // sau @ la ten ham web controller la ten file
//Route::get("/register","WebController@registerPage"); // sau @ la ten ham web controller la ten file
//Route::get("/forgotpassword","WebController@forgotpassword");
Route::group(["middleware"=>["admin","auth"],"prefix"=>"admin"],function(){ // prefix là tiền tố nằm trước link route
   require_once "admin.php";
});
//category


