<?php

namespace amin3520\Anar\Tests\TestSupport\database\factories;

use amin3520\Anar\Tests\TestSupport\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * @var class-string<Post>
     */
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence,
            'text'         => $this->faker->paragraph,
            'status'       => $this->faker->randomElement(['draft', 'published']),
            'is_published' => false,
        ];
    }
}
