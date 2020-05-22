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

Route::get('/',"WebController@index");
// tạo thêm router mới sau / l
//à đường dẫn đến routing  // goi duong dan duong file controller ma khong can phai viet ham ham se duoc viet o controller
Route::get("/login","WebController@loginPage"); // sau @ la ten ham web controller la ten file
Route::get("/register","WebController@registerPage"); // sau @ la ten ham web controller la ten file
Route::get("/forgotpassword","WebController@forgotpassword");
//category
Route::get("/list-category","WebController@listCategory");
Route::get("/new-category","WebController@newCategory");
// post new category
Route::post("/save-category","WebController@saveCategory");
Route::get("/list-brand","WebController@listBrand");
Route::get("/new-brand","WebController@newBrand");
Route::post("/save-brand","WebController@saveBrand");
// update
Route::get("/edit-category/{id}","WebController@editCategory"); // id truyền vào tương đương với querry parameter
Route::put("/update-category/{id}","WebController@updateCategory");
Route::get("/edit-brand/{id}","WebController@editBrand"); // id truyền vào tương đương với querry parameter
Route::put("/update-brand/{id}","WebController@updateBrand");
//Delete
Route::delete("/delete-brand/{id}","WebController@deleteBrand");
