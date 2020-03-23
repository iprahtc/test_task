<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PublicationSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(AnswerCommentSeeder::class);
    }
}
