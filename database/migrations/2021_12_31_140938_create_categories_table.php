<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
