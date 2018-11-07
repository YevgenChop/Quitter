<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Reply;
use App\Models\User;

class MessageService
{

    /**
     * Get paginated list of messages
     *
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function listMessages(int $page, int $perPage): array
    {
        return Message::with('replies')->get()->forPage($page, $perPage)->toArray();
    }

    /**
     * Get paginated list of replies
     *
     * @param int $messageId
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function listReplies(int $messageId, int $page, int $perPage): array
    {
        return Message::find($messageId)
        ->replies()
        ->forPage($page, $perPage)
        ->get()
        ->toArray();
    }

    /**
     * Create new message
     *
     * @param $id
     * @param $data
     * @return Message
     */
    public function message(int $id, array $data): Message
    {
        return User::findOrFail($id)->messages()->create($data);
    }

    /**
     * Create new message reply
     *
     * @param $id
     * @param int $messageId
     * @param $data
     * @return Reply
     */
    public function reply($id, int $messageId, array $data): Reply
    {
        $user = User::findOrFail($id);

        return Message::findOrFail($messageId)
            ->replies()
            ->create([
                'user_id' => $user->id,
                'text' => $data['text']
            ]);
    }

    /**
     * Get message by id
     *
     * @param $id
     * @return array
     */
    public function getMessage(int $id): array
    {
        return Message::with('replies')->findOrFail($id)->toArray();
    }

    /**
     * Get reply by id
     *
     * @param $quitId
     * @param $id
     * @return array
     */
    public function getReply(int $id): array
    {
        return Reply::with('message')->findOrFail($id)->toArray();
    }

    /**
     * Get messages count
     *
     * @return int
     */
    public function countMessages(): int
    {
        return Message::all()->count();
    }

    /**
     * Get replies count on message
     *
     * @param int $messageId
     * @return int
     */
    public function countReplies(int $messageId): int
    {
        return Message::findOrFail($messageId)->replies()->count();
    }

    /**
     * Update message by id
     *
     * @param $userId
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateMessage(int $id, array $data): bool
    {
        $message = Message::findOrFail($id);

        $message->fill($data);

        return $message->save();
    }

    /**
     * Update reply by id
     *
     * @param $userId
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateReply(int $id, array $data): bool
    {
        $reply = Reply::findOrFail($id);

        $reply->fill($data);

        return $reply->save();
    }

    /**
     * Delete message with replies relations
     *
     * @param $userId
     * @param $id
     * @return bool
     */
    public function deleteMessage(int $id): bool
    {
        $message = Message::findOrFail($id);

        $message->replies()->delete();

        return $message->delete();
    }

    /**
     * Delete reply
     *
     * @param $userId
     * @param $id
     * @return bool
     */
    public function deleteReply(int $id): bool
    {
        $reply = Reply::findOrFail($id);

        return $reply->delete();
    }
}
