<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =  ['Admin','Provider','Client'];

        foreach ($roles as $role) 
        {
            Role::updateOrCreate([
                'name' => $role
            ]);
        }
    }
}
