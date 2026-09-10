<?php

namespace Database\Seeders;

use App\Models\adminProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminProfileSeeder extends Seeder
{
    public function run(): void
    {
        adminProfile::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin1',
                'password' => Hash::make('admin123'),
                'department' => 'cse',
            ],
        );
    }
}
