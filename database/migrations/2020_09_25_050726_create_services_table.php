<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('author_id');
            $table->integer('category_id')->nullable();
            $table->integer('price')->nullable()->default(0);
            $table->string('title');
//            $table->string('seo_title')->nullable();
//            $table->text('excerpt');
            $table->text('body')->nullable();
            $table->string('image')->nullable();
//            $table->string('slug')->unique();
//            $table->text('meta_description');
//            $table->text('meta_keywords');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
//            $table->boolean('featured')->default(0);
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
        Schema::dropIfExists('services');
    }
}
