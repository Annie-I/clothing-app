<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateItemStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });


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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_states');
    }
}
