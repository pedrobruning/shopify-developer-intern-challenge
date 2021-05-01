<?php

namespace Database\Factories;

use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->faker->randomElement([
                'storage/photos/seeds/pedroOne.jpg',
                'storage/photos/seeds/pedroTwo.jpg',
                'storage/photos/seeds/pedroThree.jpg'
            ]),
            'original_name' => $this->faker->randomElement(['pedroOne.jpg', 'pedroTwo.jpg', 'pedroThree.jpg']),
            'title' => $this->faker->text(15),
            'description' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(20000, 120000),
            'discount' => $this->faker->numberBetween(0,19900)
        ];
    }
}
