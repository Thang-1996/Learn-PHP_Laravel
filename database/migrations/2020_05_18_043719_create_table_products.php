<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("product_name");
            $table->string("product_desc");
            $table->decimal("price",12,4); //  tối đa 12 chữ số
            $table->unsignedInteger("qty")->default(1); // default là giá trị mặc định khi thêm 1 hàng trong database // unsigned số không âm
            $table->unsignedBigInteger("category_id"); // tạo trường cho cột khóa ngoại //  kiểu unsignedBiginterger(không âm ) tương đương với kiểu id20 của bảng chính
            // gán khóa ngoại cho bảng category_id // references tham chiếu đến column id của bảng categories
            $table->foreign("category_id")->references("id")->on("categories");
            $table->unsignedBigInteger("brand_id");
            $table->foreign("brand_id")->references("id")->on("brands");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
