<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $path = [
            'storage/photos/seeds/pedroOne.jpg',
            'storage/photos/seeds/pedroTwo.jpg',
            'storage/photos/seeds/pedroThree.jpg'
        ];
        foreach($users as $user) {
            for($i = 0; $i <= 2; $i++) {
                $user->photos()->create([
                    'path' => $path[$i],
                    'original_name' => $path[$i],
                    'artist_id' => $user->id,
                    'title' => "Photo Title here!",
                    'description' => "Photo Description here!",
                    'price' => mt_rand(10000, 99999),
                    'discount' => mt_rand(1000, 9999),
                ]);
            }
        }
    }
}
