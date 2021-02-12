<?php

namespace App\Policies;

use App\Models\HotlineMessage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotlinePolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        return $user->isModerator() ? true : null;
    }

    public function create(User $user)
    {
        // TODO
        return true;
    }

    public function update(User $user, HotlineMessage $hotlineMessage)
    {
        return $user->id === $hotlineMessage->user_id;
    }

    public function delete(User $user, HotlineMessage $hotlineMessage)
    {
        return $user->id === $hotlineMessage->user_id;
    }

    public function customize(User $user){
        return $user->isVip();
    }

}
