<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       //  hàm up để dùng các cơ chế như tạo bảng cập nhật hay update
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("category_name")->unique(); // tạo trường category_name với kiểu string unique để cho dữ liệu khi tạo ra không bị trùng
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
        // hàm down chạy khi muốn rollback drop dữ dữ liệu bảng
        Schema::dropIfExists('categories');
    }
}
