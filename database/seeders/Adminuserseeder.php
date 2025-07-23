<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for( $i = 0; $i < 10; $i++ ) {
        User::updateOrCreate(
            ['email' => "root{$i}@root.com"],
            [
                'name' => "Root{$i}",
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );
    }
}
}