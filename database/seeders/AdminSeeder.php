<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::on('mysql')->firstOrCreate(
            ['email' => 'admin@gmail.com'], // unique identifier
            [
                'name' => 'Central Admin',
                'password' => Hash::make('password'),
            ]
        );

        $this->command->info('Central Admin user created successfully!');
    }
}
