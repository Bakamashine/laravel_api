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

        Role::insert([
            [
                "role_name" => "Администратор",
                "abilities" => json_encode(['*'])
            ],
            [
                "role_name" => "Официант",
                "abilities" => json_encode([
                    'create_order',
                    'get_order_with_id',
                    'get_all_order_waiter',
                    'update_status_waiter'
                ])
            ],
            [
                "role_name" => "Повар",
                "abilities" => json_encode([
                    'get_order_cook',
                    'update_status_cook'
                ])
            ]
        ]);
    }
}
