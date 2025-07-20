<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class Mediaseeder extends Seeder
{
    public function run(): void
    {
        Media::create([
            'file_name' => 'sample.jpg',  // path relative to /storage/
            'file_path' => 'images/sample.jpg', // path relative to /storage/app/public/
            'mime_type' => 'image/jpg',
        ]);
    }
}
