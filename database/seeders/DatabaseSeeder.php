<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Person;
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
        Account::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ],
        );

        // Person::factory(10)->create();

        Person::query()->firstOrCreate([
            'name' => 'Test Person',
            'email' => 'test@example.com',
        ]);
    }
}
