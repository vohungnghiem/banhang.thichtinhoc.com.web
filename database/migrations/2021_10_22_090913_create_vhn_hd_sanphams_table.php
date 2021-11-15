<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVhnHdSanphamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vhn_hd_sanphams', function (Blueprint $table) {
            $table->integer('id_hd');
            $table->integer('id_type')->nullable();
            $table->unsignedInteger('stt');
            $table->integer('id_sp');
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->integer('warranty')->nullable();

            $table->foreign('id_sp')->references('id')->on('vhn_products')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(array('id_hd','id_type','stt'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vhn_hd_sanphams');
    }
}
