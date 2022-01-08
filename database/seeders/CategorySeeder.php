<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'sieviešu aksesuāri',
            'sieviešu apavi',
            'sieviešu apģērbs',
            'vīriešu aksesuāri',
            'vīriešu apavi',
            'vīriešu apģērbs',
            'bērnu aksesuāri',
            'bērnu apavi',
            'bērnu apģērbs',
            'bērnu rotaļlietas',
            'bērnu skolas piederumi',
            'dekori',
            'grāmatas',
            'interjera priekšmeti',
            'mēbeles',
            'remontam',
            'tehnika',
            'instrumenti',
            'cits',
        ];

        foreach($categories as $category)
        {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
}