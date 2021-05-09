<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'see-post'],
            ['name' => 'create-post'],
            ['name' => 'update-post'],
            ['name' => 'publish-post'],
            ['name' => 'delete-post'],
            ['name' => 'force-delete-post'],
            ['name' => 'restore-post'],
            ['name' => 'see-others-posts'],
            ['name' => 'update-others-posts'],
            ['name' => 'publish-others-posts'],
            ['name' => 'delete-others-posts'],
            ['name' => 'force-delete-others-posts'],
            ['name' => 'restore-others-posts'],
            ['name' => 'edit-user'],
            ['name' => 'delete-user'],
            ['name' => 'create-other-users'],
            ['name' => 'edit-other-users'],
            ['name' => 'delete-other-users'],
        ]);
    }
}
