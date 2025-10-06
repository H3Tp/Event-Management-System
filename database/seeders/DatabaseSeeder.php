<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'organizer',
            'email' => 'organizer@gmail.com',
            'password' => Hash::make('Password@1'),
            'is_admin' => 1
        ]);

        User::create([
            'name' => 'organizer1',
            'email' => 'organizer1@gmail.com',
            'password' => Hash::make('Password@1'),
            'is_admin' => 2
        ]);

        
    }
}
