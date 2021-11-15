<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVhnHdTunhapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vhn_hd_tunhaps', function (Blueprint $table) {
            $table->unsignedInteger('id_hd');
            $table->unsignedInteger('stt');
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->integer('warranty')->nullable();

            $table->foreign('id_hd')->references('id')->on('vhn_hoadon_pros')
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
        Schema::dropIfExists('vhn_hd_tunhaps');
    }
}
