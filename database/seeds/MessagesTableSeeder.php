<?php

use App\Models\Message;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::all()->shuffle()->each(function (User $user) {
            factory(Message::class, random_int(0, 2))->create([
                'user_id' => $user->id,
            ])->shuffle()->each(function (Message $message) {
                factory(Reply::class, random_int(0, 2))->create([
                    'user_id' => $message->user->id,
                    'message_id' => $message->id
                ]);
            });
        });
    }
}
