<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Adminuserseeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Mediaseeder::class);
        $this->call(AdminUserseeder::class);
        $this->call(ArticleSeeder::class);
        // Create 30 test users
        for($i=0; $i<30;$i++){
        User::factory()->create([
            'name' => "Test-User{$i}",
            'email' => "user{$i}@user.com",
            'password' => Hash::make('12345678'),
        ]);
    }
    }
}
