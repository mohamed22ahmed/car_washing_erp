<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => '$2y$10$lHL0JXJ9LL4jkdmJ4IknluliSm5.X.7./WVatpyE0V2HRlTBUIdRu',
            'remember_token' => null,
            'created_at'     => '2019-04-15 19:13:32',
            'updated_at'     => '2019-04-15 19:13:32',
        ]];

        User::insert($users);
    }
}
