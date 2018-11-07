<?php

namespace App\Models;

use App\Events\ReplyCreated;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reply
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $message_id
 * @property string $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Message| $message
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Reply extends Model
{
       /**
     * The event map for the model.
     *
     * @var array
     */
     protected $dispatchesEvents = [
         'created' => ReplyCreated::class,
     ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'message_id', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo | User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo | Message
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
