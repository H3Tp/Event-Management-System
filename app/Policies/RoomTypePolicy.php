<?php

namespace App\Policies;

use App\Models\EventType;
use App\Models\User;

class RoomTypePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

public function update(User $user, EventType $roomType): bool
{
    // Admin ko full permission
    if ($user->is_admin == 1) {
        return true;
    }

    // Normal users restrictions
    return !in_array($roomType->name, ['Standard', 'Deluxe', 'Superior']);
}

public function delete(User $user, EventType $roomType): bool
{
    if ($user->is_admin == 1) {
        return true;
    }

    return !in_array($roomType->name, ['Standard', 'Deluxe', 'Superior']);
}
}
