<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('brand_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('old_price')->nullable();
            $table->integer('selling_price')->nullable();
            $table->tinyInteger('trending')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('small_desc')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('properties')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
};
