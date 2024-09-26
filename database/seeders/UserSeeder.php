<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array('name' => 'Admin', 'email' => 'admin@admin.com', 'phone' => '123098123', 'password' => bcrypt('admin'), 'role' => 'admin', 'avatar' => 'https://avatars.dicebear.com/api/adventurer/admin.svg', 'email_verified_at' => null, 'remember_token' => null, 'created_at' => now(), 'updated_at' => now()),

            array('name' => 'Customer', 'email' => 'customer@customer.com', 'phone' => '123098123', 'password' => bcrypt('customer'), 'role' => 'customer', 'avatar' => 'https://avatars.dicebear.com/api/adventurer/customer.svg', 'email_verified_at' => null, 'remember_token' => null, 'created_at' => now(), 'updated_at' => now()),
        );

        User::insert($users);
    }
}
