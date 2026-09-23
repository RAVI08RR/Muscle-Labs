<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Lunar\Admin\Models\Staff;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Default customer user
        User::firstOrCreate(
            ['email' => 'customer@musclelabs.co.uk'],
            [
                'name'     => 'Research Customer',
                'password' => Hash::make('password'),
            ]
        );

        // Filament Staff admin user
        Staff::firstOrCreate(
            ['email' => 'admin@musclelabs.co.uk'],
            [
                'firstname' => 'Admin',
                'lastname'  => 'User',
                'admin'     => true,
                'password'  => Hash::make('password'),
            ]
        );

        $this->command->info('Default customer & admin staff created successfully.');
    }
}
