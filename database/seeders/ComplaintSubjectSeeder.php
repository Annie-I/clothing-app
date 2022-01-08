<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            'lietotājs',
            'sludinājums',
        ];

        foreach($subjects as $subject)
        {
            DB::table('complaint_subjects')->insert([
                'name' => $subject,
            ]);
        }
    }
}
