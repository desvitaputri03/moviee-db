<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        $movies = [
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years...',
                'year' => 1994,
                'genre' => 'Drama'
            ],
            [
                'title' => 'The Godfather',
                'description' => 'The aging patriarch of an organized crime dynasty...',
                'year' => 1972,
                'genre' => 'Crime'
            ],
            // Add more movies as needed
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}