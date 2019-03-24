<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageReviewsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
Schema::create('pages', function (Blueprint $table) {
        $table->increments('id');
        $table->text('path');
        $table->timestamps();
    });
    Schema::create('reviews', function (Blueprint $table) {
        $table->increments('id');
        $table->text('page_id');
        $table->text('username');
        $table->text('comment');
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
        
Schema::dropIfExists('pages');
    Schema::dropIfExists('reviews');
    }
}
