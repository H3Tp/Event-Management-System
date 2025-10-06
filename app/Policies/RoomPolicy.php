<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class RoomPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Event $room): bool
    {
        // Admin ko full permission
        if ($user->is_admin == 1) {
            return true;
        }

        // Normal users restrictions
        return !in_array($room->id, [1]);
    }

    public function delete(User $user, Event $room): bool
    {
        // Admin ko full permission
        if ($user->is_admin == 1) {
            return true;
        }

        // Normal users restrictions
        return !in_array($room->id, [1]);
    }
}
