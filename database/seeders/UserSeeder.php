<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'administrador@admin.com',
            'password' => bcrypt('bloonde4dm1n'),
            'status_id' => 1,
            'profile_id' => 1
        ]);
    }
}
