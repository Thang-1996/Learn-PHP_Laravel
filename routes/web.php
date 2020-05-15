<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// tạo thêm router mới sau / là đường dẫn đến routing  // goi duong dan duong file controller ma khong can phai viet ham ham se duoc viet o controller
Route::get("/login","WebController@loginPage"); // sau @ la ten ham web controller la ten file
Route::get("/register","WebController@registerPage"); // sau @ la ten ham web controller la ten file
Route::get("/forgotpassword","WebController@forgotpassword");

