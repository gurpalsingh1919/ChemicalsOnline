<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::updateOrCreate(
            ['email' => 'admin@pharmachemonline.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('SuperSecurePassword123'),
                'role' => 'super_admin'
            ]
        );
    }
}
