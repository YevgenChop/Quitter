<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the peply.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Peply  $peply
     * @return mixed
     */
    public function update(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;
    }

    /**
     * Determine whether the user can delete the peply.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Peply  $peply
     * @return mixed
     */
    public function destroy(User $user, Reply $reply)
    {
        return $user->id === $reply->user_id;
    }
}
