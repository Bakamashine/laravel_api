<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table("role")->insert(
        //     [
        //         ["id" => 1, "role_name" => "Администратор",],
        //         ["id" => 2, "role_name" => "Официант",],
        //         ["id" => 3, "role_name" => "Повара",]
        //     ]
        // );

        Role::create([
            [
                "role_name" => "Администратор",
                "abilities" => '[*]'
            ],
            [
                "role_name" => "Официант",
                "abilities" => '[*]'
            ],
            [
                "role_name" => "Повара",
                "abilities" => '[*]'
            ]
        ]);
    }
}
