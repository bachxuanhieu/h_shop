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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('newscategory_id');
            $table->string('name');
            $table->longText('desc');
            $table->string('image')->nullable();    
            $table->string('author')->nullable(); 
            $table->tinyInteger('status')->default(1);
            $table->foreign('newscategory_id')->references('id')->on('news_category')->onDelete('cascade');   
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
        Schema::dropIfExists('news');
    }
};
