<?php
Route::get("/","WebController@dashBoard");
Route::get("/list-category","CategoryController@listCategory"); // set quyen dang nhap moi dc acess vao
Route::get("/new-category","CategoryController@newCategory");
Route::get("/edit-category/{id}","CategoryController@editCategory"); // id truyền vào tương đương với querry parameter
Route::put("/update-category/{id}","CategoryController@updateCategory");
Route::post("/save-category","CategoryController@saveCategory");
Route::delete("/delete-category/{id}","CategoryController@deleteCategory");
// brand
Route::get("/list-brand","BrandController@listBrand");
Route::get("/new-brand","BrandController@newBrand");
Route::post("/save-brand","BrandController@saveBrand");
Route::get("/edit-brand/{id}","BrandController@editBrand"); // id truyền vào tương đương với querry parameter
Route::put("/update-brand/{id}","BrandbController@updateBrand");
Route::delete("/delete-brand/{id}","BrandController@deleteBrand");

// Product
Route::get("/list-product","ProductController@listProduct");
Route::get("/new-product","ProductController@newProduct");
Route::post("/save-product","ProductController@saveProduct");
Route::delete("/delete-product/{id}","ProductController@deleteProduct");
Route::put("/update-product/{id}","ProductController@updateProduct");
Route::get("/edit-product/{id}","ProductController@editProduct");

