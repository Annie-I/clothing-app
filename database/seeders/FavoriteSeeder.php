<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favorites = [2, 5, 7, 9, 11, 14, 16, 17, 18, 20];

        foreach($favorites as $favorite)
        {
            DB::table('favorites')->insert([
                'user_id' => '1',
                'favorite_id' => $favorite,
            ]);
        }
    }
}
