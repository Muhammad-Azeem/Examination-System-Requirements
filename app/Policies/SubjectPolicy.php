<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('admin'); // Example condition
    }

    public function view(User $user, Subject $subject)
    {
        return $user->hasRole('admin'); // Example condition
    }

    public function create(User $user)
    {
        return $user->hasRole('admin'); // Example condition
    }

    public function update(User $user, Subject $subject)
    {
        return $user->hasRole('admin'); // Example condition
    }

    public function delete(User $user, Subject $subject)
    {
        return $user->hasRole('admin'); // Example condition
    }
}
