<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalToDevvnTinhthanhphoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devvn_tinhthanhpho', function (Blueprint $table) {
            $table->boolean('approval')->default(0);
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
        Schema::table('devvn_tinhthanhpho', function (Blueprint $table) {
            $table->dropColumn('approval');
            $table->dropTimestamps();
        });
    }
}
