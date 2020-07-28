<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTintucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tintuc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('TieuDe');
            $table->text('TieuDeKhongDau');
            $table->text('TomTat');
            $table->text('NoiDung');
            $table->text('Hinh');
            $table->text('NoiBat');
            $table->integer('idLoaiTin');

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
        Schema::dropIfExists('tbl_tintuc');
    }
}
