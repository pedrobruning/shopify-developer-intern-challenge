<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
            'https://www.lance.com.br/files/article_main/uploads/2020/10/14/5f877029190dc.jpeg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeM90-vw6cIu7SrPOD6eAyEvW8lCgBLRU0og&usqp=CAU',
            'https://static-wp-tor15-prd.torcedores.com/wp-content/uploads/2020/11/neymar-jr-10.jpeg'
        ];
        foreach($users as $user) {
            for($i = 0; $i <= 2; $i++) {
                $user->photos()->create([
                    'path' => $path[$i],
                    'original_name' => $path[$i],
                    'artist_id' => $user->id,
                    'title' => "Photo Title here!",
                    'description' => "Photo Description here!",
                    'bought' => 1,
                    'price' => mt_rand(10000, 99999),
                    'discount' => mt_rand(1000, 9999),
                ]);
            }
        }
    }
}
