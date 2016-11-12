<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $thread = App\Thread::find(2);
        $comment = new App\Comment;

        $comment->body = '<p>Comment it</p>';
        $comment->user_id = 1;
        $thread->comments()->save($comment);


    }
}
