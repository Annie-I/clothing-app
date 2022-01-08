<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FavoriteSeeder::class,
            MessageSeeder::class,
            CategorySeeder::class,
            ItemStateSeeder::class,
            ItemSeeder::class,
            ReviewSeeder::class,
            ComplaintStatusSeeder::class,
            ComplaintSubjectSeeder::class,
            ComplaintSeeder::class,
        ]);
    }
}
