<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVhnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vhn_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity')->nullable();
            $table->bigInteger('price_sale')->nullable();
            $table->bigInteger('price_import')->nullable();
            $table->dateTime('date_import')->nullable();
            $table->integer('id_supplier')->nullable();
            $table->integer('warranty')->nullable();
            $table->string('location')->nullable();
            $table->string('location_image')->nullable();

            $table->integer('sort')->nullable()->default(1);
            $table->tinyInteger('status')->nullable()->default(1);
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
        Schema::dropIfExists('vhn_products');
    }
}
