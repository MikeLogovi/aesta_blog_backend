<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
          
            $table->string('title')->unique();
            $table->string('slug')->nullable();
            $table->string('picture')->nullable();
            $table->text('description');
            $table->longText('htmlCode')->nullable();
            $table->longText('jsonCode')->nullable();
            $table->string('pdf')->nullable();
            $table->string('picture_link')->nullable();
            $table->string('pdf_link')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
