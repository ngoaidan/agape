<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Cải thiện cuộc sống',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:35:50',
                'updated_at' => '2020-09-01 09:40:24',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Chăm sóc sức khoẻ',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:35:50',
                'updated_at' => '2020-09-01 09:43:50',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Gia Tăng Phúc Lợi',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:44:13',
                'updated_at' => '2020-09-01 09:44:13',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Giải pháp tài chính',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:44:22',
                'updated_at' => '2020-09-01 09:44:22',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 1,
                'order' => 1,
                'name' => 'Đời sống vật chất',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:45:02',
                'updated_at' => '2020-09-01 09:45:13',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 1,
                'order' => 1,
                'name' => 'Đời sống tri thức',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:50:55',
                'updated_at' => '2020-09-01 09:51:51',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 1,
                'order' => 1,
                'name' => 'Đời sống tinh thần',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:52:01',
                'updated_at' => '2020-09-01 09:52:01',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 1,
                'order' => 1,
                'name' => 'Nhật ký cảm xúc',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:52:31',
                'updated_at' => '2020-09-01 09:52:31',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 5,
                'order' => 1,
                'name' => 'Điện tử - Điện lạnh',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:57:33',
                'updated_at' => '2020-09-01 09:58:01',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 5,
                'order' => 1,
                'name' => 'Điện thoại - Máy tính bảng',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:58:35',
                'updated_at' => '2020-09-01 09:59:27',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 5,
                'order' => 1,
                'name' => 'Điện gia dụng',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 09:59:04',
                'updated_at' => '2020-09-01 09:59:14',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 5,
                'order' => 1,
                'name' => 'Xe hơi - xe máy - xe điện',
                'description' => NULL,
                'image' => NULL,
                'created_at' => '2020-09-01 10:00:03',
                'updated_at' => '2020-09-01 10:00:03',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => 5,
                'order' => 1,
                'name' => 'Nhà ở xã hội',
                'description' => '<p>Day la danh muc</p>',
                'image' => 'categories/September2020/TAnqdka86bo6VjFNBLvb.png',
                'created_at' => '2020-09-01 10:01:36',
                'updated_at' => '2020-09-17 07:43:53',
            ),
        ));
        
        
    }
}