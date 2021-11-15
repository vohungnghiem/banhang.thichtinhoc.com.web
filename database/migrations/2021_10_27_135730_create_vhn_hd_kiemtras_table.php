<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVhnHdKiemtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vhn_hd_kiemtras', function (Blueprint $table) {
            $table->unsignedInteger('id_hd');
            $table->integer('stt');
            $table->string('name')->nullable();
            $table->string('benhtrang')->nullable();
            $table->string('dexuat')->nullable();
            $table->string('ghichu')->nullable();
            $table->integer('fee')->nullable()->default(0);

            $table->foreign('id_hd')->references('id')->on('vhn_hoadon_scs')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('id_hd','stt'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vhn_hd_kiemtras');
    }
}
