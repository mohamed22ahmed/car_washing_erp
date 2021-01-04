<?php

use App\Models\code_table;
use Illuminate\Database\Seeder;

class CodetablesTableSeeder extends Seeder
{
    public function run()
    {
        $code_tables = [[
                'id'            => '1',
                'sys_code_type' => '1',
                'sys_code'      => '1',
                'name'          => 'red',
                'name_ar'       => 'أحمر',
                'created_at' => '2020-04-15 19:14:42',
                'updated_at' => '2020-04-15 19:14:42',
            ],
            [
                'id'            => '2',
                'sys_code_type' => '1',
                'sys_code'      => '2',
                'name'          => 'Black',
                'name_ar'       => 'أسود',
                'created_at' => '2020-04-15 19:14:42',
                'updated_at' => '2020-04-15 19:14:42',
            ],
            [
                'id'            => '3',
                'sys_code_type' => '2',
                'sys_code'      => '1',
                'name'          => 'BMW',
                'name_ar'       => 'بى ام دبليو',
                'created_at' => '2020-04-15 19:14:42',
                'updated_at' => '2020-04-15 19:14:42',
            ],
            [
                'id'            => '4',
                'sys_code_type' => '2',
                'sys_code'      => '2',
                'name'          => 'Fiat',
                'name_ar'       => 'فيات',
                'created_at' => '2020-04-15 19:14:42',
                'updated_at' => '2020-04-15 19:14:42',
            ],
            [
                'id'            => '5',
                'sys_code_type' => '3',
                'sys_code'      => '1',
                'name'          => 'New',
                'name_ar'       => 'جديد',
                'created_at' => '2020-04-15 19:14:42',
                'updated_at' => '2020-04-15 19:14:42',
            ],
            [
                'id'            => '6',
                'sys_code_type' => '3',
                'sys_code'      => '2',
                'name'          => 'old',
                'name_ar'       => 'قديم',
                'created_at' => '2020-04-15 19:14:42',
                'updated_at' => '2020-04-15 19:14:42',
            ],

        ];

        code_table::insert($code_tables);
    }
}
