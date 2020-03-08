<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignFieldsForArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
             $table->bigInteger('user_id')->unsigned();
             $table->bigInteger('department_id')->unsigned();
             $table->bigInteger('category_id')->unsigned();
             $table->foreign('user_id')->references('id')->on('users');
             $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
             $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
