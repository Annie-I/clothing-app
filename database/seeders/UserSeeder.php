<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin account
        DB::table('users')->insert([
            'first_name' => 'test',
            'last_name' => 'admin',
            'birth_date' => '1971-05-25',
            'location' => 'Tukums',
            'email' => 'admin@test.acc',
            'email_verified_at' => '2022-01-02 13:08:04',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_admin' => 1,
        ]);

        User::factory(20)
            ->create();
    }
}
