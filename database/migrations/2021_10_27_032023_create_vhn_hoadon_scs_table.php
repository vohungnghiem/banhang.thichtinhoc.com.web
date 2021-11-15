<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVhnHoadonScsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vhn_hoadon_scs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mahoadon')->nullable();
            $table->dateTime('thoigian')->nullable();
            $table->dateTime('ngaytra')->nullable();
            $table->string('tenkh')->nullable();
            $table->string('diachi')->nullable();
            $table->string('sdt')->nullable();
            $table->string('email')->nullable();
            $table->string('dulieucangiu')->nullable();
            $table->integer('loaidichvu')->nullable()->default(1);
            $table->string('loinhuan')->nullable();
            $table->integer('sort')->nullable()->default(1);
            $table->tinyInteger('status')->nullable()->default(0);
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
        Schema::dropIfExists('vhn_hoadon_scs');
    }
}
