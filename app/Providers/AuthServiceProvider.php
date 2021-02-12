<?php

namespace App\Providers;

use App\Models\HotlineMessage;
use App\Models\Listing;
use App\Models\Role;
use App\Models\User;
use App\Policies\HotlinePolicy;
use App\Policies\ListingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Listing::class => ListingPolicy::class,
        User::class => UserPolicy::class,
        HotlineMessage::class => HotlinePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
