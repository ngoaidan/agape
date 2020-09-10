<?php

use Illuminate\Database\Seeder;

class EnterprisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('enterprises')->insert([
            'name' => 'Công Ty Cổ Phần Dệt 10/10',
            'code' => 'DET10',
            'matp' => '01',
        ]);

        DB::table('enterprises')->insert([
            'name' => 'Công Ty Cổ Phần May Sông Hồng',
            'code' => 'JSC',
            'matp' => '01',
        ]);

        DB::table('enterprises')->insert([
            'name' => 'Tổng Công Ty Cổ Phần May Nhà Bè',
            'code' => 'NBC',
            'matp' => '79',
        ]);

        DB::table('enterprises')->insert([
            'name' => 'Tổng Công ty dệt may Gia Định',
            'code' => 'GIDITEX',
            'matp' => '79',
        ]);

        DB::table('enterprises')->insert([
            'name' => 'Công ty cổ phần dệt may 29 - 3',
            'code' => 'HACHIBA',
            'matp' => '48',
        ]);
    }
}
