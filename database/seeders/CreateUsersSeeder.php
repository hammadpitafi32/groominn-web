<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        User::updateOrCreate([
            'email' => 'admin@grooming.com',
        ],
        [
            'name' => 'admin',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);
        User::updateOrCreate([
            'email' => 'provider@grooming.com',
        ],
        [
            'name' => 'provider',
            'password' => Hash::make('123456'),
            'role_id' => 2,
        ]);

        User::updateOrCreate([
            'email' => 'client@grooming.com',
        ],
        [
            'name' => 'client',
            'password' => Hash::make('123456'),
            'role_id' => 3,
        ]);
        
    }
}
