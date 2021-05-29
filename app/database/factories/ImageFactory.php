<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;


class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $image = Image::class;
    protected $blogs = Blog::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'filename' => $this->faker->word(),
            'extension' => $this->faker->fileExtension(),
            'blog_id' => $this->faker->randomElement($this->blogs::all()->pluck('id')),
            'alt' => $this->faker->sentence(),
        ];
    }
}
