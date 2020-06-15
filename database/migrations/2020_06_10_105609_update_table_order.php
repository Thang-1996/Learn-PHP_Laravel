<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("user_name")->after("user_id");
            $table->text("address")->after("user_name");
            $table->string("telephone")->after("address");
            $table->string("note")->after("telephone")->nullable();
            $table->unsignedInteger("status")->default(0)->after("grand_total");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(["user_name"]);
            $table->dropColumn(["address"]);
            $table->dropColumn(["telephone"]);
            $table->dropColumn(["note"]);
            $table->dropColumn(["status"]);
        });
    }
}
