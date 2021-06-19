<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new()->create([
            'email'             => 'admin@admin.com',
            'roles'             => 'Managerial',
            'name'              => 'admin',
            'employee_level_id' => 1
        ]);

        UserFactory::new()->create([
            'email'             => 'manager@lte.com',
            'roles'             => 'Staff',
            'name'              => 'staff',
            'employee_level_id' => 1
        ]);
    }
}
