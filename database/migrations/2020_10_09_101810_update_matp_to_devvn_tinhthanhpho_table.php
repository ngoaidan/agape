<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMatpToDevvnTinhthanhphoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devvn_tinhthanhpho', function (Blueprint $table) {
            $table->increments('matp')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devvn_tinhthanhpho', function (Blueprint $table) {
            $table->char('matp',5)->change();
        });
    }
}
