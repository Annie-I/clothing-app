<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });


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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_subjects');
    }
}
