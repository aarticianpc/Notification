<?php

namespace Wingmaxx\Notification;

use Illuminate\Support\ServiceProvider;
use Wingmaxx\Notification\Notification;
use DB;

class NotificationrServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Wingmaxx\Notification\NotificationController');
        $this->loadViewsFrom(__DIR__.'/views', 'notification');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
           $data=Notification::whereBetween(DB::raw('NOW()'),[DB::raw('startdate'),DB::raw('enddate')])->get();
           $notdata='';
           foreach($data as $ms){
                $notdata.="<p class='cls-wt-notification alert alert-warning'>$ms->message</p>";
           }
            view()->share([
                'wt_notification' => $notdata,
            ]);
    }
}
