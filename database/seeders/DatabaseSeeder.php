<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $createReviews = function (Book $book, $rating) {
        $numberOfReviews = random_int(5, 30);
        Review::factory()->count($numberOfReviews)
            ->{$rating}()
            ->for($book)
            ->create();
    };

    Book::factory(33)->create()->each(function (Book $book) use ($createReviews) {
        $createReviews($book, 'bad');
    });
    Book::factory(33)->create()->each(function (Book $book) use ($createReviews) {
        $createReviews($book, 'average');
    });
    Book::factory(34)->create()->each(function (Book $book) use ($createReviews) {
        $createReviews($book, 'good');
    });
}
}
