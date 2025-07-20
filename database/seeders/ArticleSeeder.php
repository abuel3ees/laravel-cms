<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Article::create([
                'title' => "Sample Article $i",
                'body' => "<p>This is a <strong>rich text</strong> body for article $i. It supports <em>HTML</em>!</p>",
                'media_id' => 1, // Assuming no media is associated for now
                'user_id' => 1, // Assuming the first user is the author
                'created_at' => now()->subDays($i),
                'updated_at' => now()->subDays($i),
            ]);
    }
}
}