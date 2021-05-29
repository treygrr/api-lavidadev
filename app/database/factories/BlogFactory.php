<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Blog;
use App\Models\User;
use App\Models\Image;
use App\Models\Tag;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /* 
       Get all of the users ids in an array as well as image to random create a foreign key
       association when creating entries
    */
    protected $users = User::class;
    protected $images = Image::class;
    protected $tags = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs($nb = 6, $asText = true),
            'author' => $this->faker->randomElement($this->users::all()->pluck('id')),
        ];
    }
}
