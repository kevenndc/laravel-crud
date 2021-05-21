<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'role_id' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('admin@passwd'),
            'created_at' => now(),
        ]);
    }
}
