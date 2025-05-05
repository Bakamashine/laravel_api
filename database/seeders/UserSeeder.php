<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(["name" => "admin", "role_id" => 1, "login" => "admin@admin.ru", "password" => Hash::make("admin")]);
        User::create(['name' => "waiter", 'role_id' => 2, 'login' => 'waiter@waiter.ru', 'password' => Hash::make("waiter")]);
        User::create(['name' => 'user', 'role_id' => 3, 'login' => 'user@user.ru', 'password' => Hash::make('user')]);
    }
}
