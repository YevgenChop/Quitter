<?php

namespace App\Events;

use App\Models\Reply;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


class ReplyCreated
{
    use Dispatchable, SerializesModels;
    /**
     * @var Reply
     */
    private $reply;

    /**
     * Create a new event instance.
     *
     * @param Reply $reply
     */
    public function __construct(Reply $reply)
    {

        $this->reply = $reply;
    }

    /**
     * @return Reply
     */
    public function getReply()
    {
        return $this->reply;
    }
}
