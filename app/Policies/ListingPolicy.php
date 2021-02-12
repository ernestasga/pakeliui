<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingPolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        return $user->isModerator() ? true : null;
    }

    public function create(User $user)
    {
        if($user->isSupporter()){
            return $user->listing()->count() < config('limits.supporter_user_max_active_listings');
        }else if($user->isVip()){
            return $user->listing()->count() < config('limits.vip_user_max_active_listings');
        }
        else if($user->isRegularUser()){
            return $user->listing()->count() < config('limits.regular_user_max_active_listings');
        }
        else{
            return true;
        }
    }

    public function update(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
    }

    public function delete(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
    }

    public function customize(User $user){
        return $user->isVip();
    }
}
