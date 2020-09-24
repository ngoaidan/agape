<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Super Admin',
                'display_name' => 'Administrator',
                'created_at' => '2020-09-01 09:15:57',
                'updated_at' => '2020-09-23 11:45:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'admin',
                'display_name' => 'Admin',
                'created_at' => '2020-09-01 09:15:57',
                'updated_at' => '2020-09-23 11:46:03',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Telesale',
                'display_name' => 'Telesale',
                'created_at' => '2020-09-24 04:27:39',
                'updated_at' => '2020-09-24 04:27:39',
            ),
        ));
        
        
    }
}