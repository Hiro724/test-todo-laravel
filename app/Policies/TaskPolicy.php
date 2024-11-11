<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
