<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(15)
            ->for(User::find(1))
            ->create();

        Post::factory()
            ->count(5)
            ->for(User::find(1))
            ->create([
                'status' => 'trashed',
                'deleted_at' => now()
            ]);
    }
}
