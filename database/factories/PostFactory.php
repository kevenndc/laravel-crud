<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraphs(6, true),
            'excerpt' => $this->faker->paragraph(),
            'published' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'featured_image' => $this->faker->imageUrl(768, 768,'Post Featured Image', true),
        ];
    }
}
