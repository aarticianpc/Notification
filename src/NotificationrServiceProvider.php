<?php

namespace Wingmaxx\Notification;

use Illuminate\Support\ServiceProvider;
use Wingmaxx\Notification\Notification;
use DB;

class NotificationrServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
           $this->loadMigrationsFrom(__DIR__.'/migrations');
           
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
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
