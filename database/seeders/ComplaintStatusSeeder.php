<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'jauna',
            'tiek izskatīta',
            'aizvērta',
        ];

        foreach($statuses as $status)
        {
            DB::table('complaint_statuses')->insert([
                'name' => $status,
            ]);
        }
    }
}
