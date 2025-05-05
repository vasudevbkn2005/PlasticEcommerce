<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed the Admin user
        $this->call([
            AdminSeeder::class, // Make sure AdminSeeder is called
        ]);

        // Optionally, you can seed other data here, like using factories.
        // User::factory(10)->create();
    }
}
