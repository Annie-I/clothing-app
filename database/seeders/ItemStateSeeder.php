<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'jauns',
            'mazlietots',
            'lietots',
        ];

        foreach($states as $state)
        {
            DB::table('item_states')->insert([
                'name' => $state,
            ]);
        }
    }
}
