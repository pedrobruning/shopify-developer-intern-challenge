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
                'https://www.lance.com.br/files/article_main/uploads/2020/10/14/5f877029190dc.jpeg',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeM90-vw6cIu7SrPOD6eAyEvW8lCgBLRU0og&usqp=CAU',
                'https://static-wp-tor15-prd.torcedores.com/wp-content/uploads/2020/11/neymar-jr-10.jpeg'
            ]),
            'original_name' => $this->faker->randomElement([
                'neymarBigPlayerOne.jpg',
                'neymarBigPlayerTwo.jpg',
                'neymarBigPlayerThree.jpg'
            ]),
            'title' => $this->faker->text(15),
            'description' => $this->faker->realText(),
            'price' => $this->faker->numberBetween(20000, 120000),
            'discount' => $this->faker->numberBetween(0,19900)
        ];
    }
}
