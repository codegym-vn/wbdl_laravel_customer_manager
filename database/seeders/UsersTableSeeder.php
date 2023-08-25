<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "admin";
        $user->email = 'admin@example.com';
        $user->password = '123456';
        $user->save();

        $user = new User();
        $user->name = "user";
        $user->email = 'user@example.com';
        $user->password = '123456';
        $user->save();
    }
}
