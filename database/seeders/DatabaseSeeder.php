<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'name' => 'Arie Setiadi',
                'email' => 'ariesetiadi.sm@gmail.com',
                'password' => Hash::make('admin'),
            ]
        ];

        foreach ($users as $user) {
            $userModel = new User();
            $userModel->username = $user['username'];
            $userModel->name = $user['name'];
            $userModel->email = $user['email'];
            $userModel->password = $user['password'];
            $userModel->save();
        }
    }
}
