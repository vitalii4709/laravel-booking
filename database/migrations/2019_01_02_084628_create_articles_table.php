<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            
            $table->id();
            $table->string('title'); 
            $table->text('content'); 
            //$table->unsignedBigInteger('user_id'); 
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->unsignedBigInteger('object_id'); 
            //$table->foreign('object_id')->references('id')->on('objects')->onDelete('cascade'); 
            $table->foreignId('object_id')->constrained()->onDelete('cascade');
            $table->dateTime('created_at'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
