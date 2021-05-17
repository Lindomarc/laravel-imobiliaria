<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'demo',
            'email' => getenv('ADMIN_EMAIL'),
            'email_verified_at' => now(),
            'password' => bcrypt(getenv('ADMIN_PASS')),
            'remember_token' => '',
            'document' => '00000000000',
            'admin' => true,
            'spouse_document'=> '00000000000'

        ]);
    }
}
