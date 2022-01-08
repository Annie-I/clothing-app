<?php

namespace Database\Seeders;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'sender_id' => 1,
            'receiver_id' => 5,
            'created_at' => Carbon::now(),
            'title' => 'Tagad nosūtīta ziņa',
            'content' => 'Tikko nosūtīta testa ziņa',
        ]);

        DB::table('messages')->insert([
            'sender_id' => 7,
            'receiver_id' => 1,
            'created_at' => Carbon::now(),
            'title' => 'Tagad saņemta ziņa',
            'content' => 'Tikko saņemta testa ziņa',
        ]);

        Message::factory(8)
        ->create();
    }
}
