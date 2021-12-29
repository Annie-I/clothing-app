<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });


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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_statuses');
    }
}
