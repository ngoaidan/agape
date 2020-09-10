<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sqlFolder = __DIR__ . '/../files/';
        $sqlFiles = scandir($sqlFolder);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($sqlFiles as $sqlFile) {
            if (!strpos($sqlFile, '.sql')) {
//                $this->command->info('error!');
                continue;
            }
            try{
                DB::unprepared(file_get_contents($sqlFolder . $sqlFile));
                echo('success with' . $sqlFile );
            }catch (\Illuminate\Database\QueryException $ex){
                echo('fail '.$ex->getMessage());
            }

        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devvn_tinhthanhpho');
        Schema::dropIfExists('devvn_quanhuyen');
        Schema::dropIfExists('devvn_xaphuongthitran');
    }
}
