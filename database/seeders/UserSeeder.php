<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("role")->insert([["id" => 1, "role_name" => "Администратор"], ["id" => 2, "role_name" => "Официант"], ["id" => 3, "role_name" => "Повара"]]);
        User::create(["name" => "admin", "role_id" => 1, "login" => "admin@admin.ru", "password" => Hash::make("admin")]);
        User::factory()->count(20)->create();
        // UserFactory::
    }
}
