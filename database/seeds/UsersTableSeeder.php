<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin_pass'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        factory(\App\Models\User::class, 20)->create();
    }
}
