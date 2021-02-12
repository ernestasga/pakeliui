<?php

namespace App\Providers;

use App\Models\HotlineMessage;
use App\Models\Listing;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Paginator::useBootstrap();
        Carbon::setUtf8(true);

        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));

        view()->composer('*', function ($view) {
            $listing_count = Listing::count();
            $hotline_count = HotlineMessage::count();
            $listing_count = $listing_count > 50 ? '50+' : $listing_count;
            $hotline_count = $hotline_count > 50 ? '50+' : $hotline_count;
            $view->with('listing_count', $listing_count)
                 ->with('hotline_count', $hotline_count);
        });

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text' => __('admin.dashboard'),
                'route'  => 'admin.home',
                'icon' => 'fas fa-fw fa-home',
            ]);
            $event->menu->add([
                'header' => __('admin.management'),
            ]);
            $event->menu->add([
                'text' => __('admin.users'),
                'route'  => 'admin.users',
                'label' => User::all()->count(),
                'icon' => 'fas fa-fw fa-user',
            ]);
            $event->menu->add([
                'text' => __('admin.listings'),
                'route'  => 'admin.listings',
                'label' => Listing::all()->count(),
                'label_color' => 'success',
                'icon' => 'fas fa-fw fa-fan',
            ]);
            $event->menu->add([
                'text' => __('admin.hotline'),
                'route'  => 'admin.hotline',
                'label' => HotlineMessage::all()->count(),
                'label_color' => 'info',
                'icon' => 'fas fa-fw fa-blog',
            ]);
            $event->menu->add([
                'header' => __('admin.subscriptions'),
            ]);
            $event->menu->add([
                'text' => __('admin.subscriptions'),
                'route'  => 'admin.subscriptions',
                'label' => Subscription::all()->count(),
                'label_color' => 'info',
                'icon' => 'fas fa-fw fa-link',
            ]);
            $event->menu->add([
                'header' => __('admin.ads'),
            ]);
            $event->menu->add([
                'text' => __('admin.ads'),
                'route'  => 'admin.ads',
                'icon' => 'fas fa-fw fa-ad',
            ]);
        });
    }

}
