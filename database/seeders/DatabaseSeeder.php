<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin (safe even if it already exists)
        User::firstOrCreate(
            ['email' => 'admin@pageturner.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Create 10 customers
        $customers = User::factory(10)->create(['role' => 'customer']);

        // Categories + Books
        $genres = [
            ['name' => 'Fiction', 'description' => 'Literary fiction, contemporary stories, and novels.'],
            ['name' => 'Non-Fiction', 'description' => 'Real-world information, science, and essays.'],
            ['name' => 'Mystery & Thriller', 'description' => 'Suspenseful stories, crime, and detective novels.'],
            ['name' => 'Sci-Fi & Fantasy', 'description' => 'Futuristic worlds and magical realms.'],
            ['name' => 'Romance', 'description' => 'Stories of love and relationships.'],
            ['name' => 'Biography', 'description' => 'Life stories of notable individuals.'],
            ['name' => 'History', 'description' => 'Historical accounts and analysis.'],
            ['name' => 'Self-Help', 'description' => 'Personal development and mental health.'],
            ['name' => 'Children\'s Books', 'description' => 'Books for kids and early readers.'],
            ['name' => 'Young Adult', 'description' => 'Stories for teens and young adults.'],
            ['name' => 'Comedy', 'description' => 'Humorous stories and lighthearted entertainment.'],
        ];

        foreach ($genres as $genre) {
            $category = Category::create($genre);
            Book::factory(6)->create(['category_id' => $category->id]);
        }

        // Reviews (each customer reviews 3–5 random books)
        $books = Book::all();
        $customers->each(function ($customer) use ($books) {
            $books->random(rand(3, 5))->each(function ($book) use ($customer) {
                Review::factory()->create([
                    'user_id' => $customer->id,
                    'book_id' => $book->id,
                ]);
            });
        });
    }
}