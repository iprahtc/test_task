<?php

use Illuminate\Database\Seeder;

class AnswerCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\AnswerComment::class, 60)->create();
    }
}
