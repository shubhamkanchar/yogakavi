<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::whereEmail('admin@yogakaavi.test')->first();
        if(!$user){
            $user = new User();
            $user->first_name = 'Yoga';
            $user->last_name = 'Kaavi';
            $user->role = 'admin';
            $user->email = 'admin@yogakaavi.test';
            $user->password = Hash::make('123456');
            $user->save();
        }
    }
}
