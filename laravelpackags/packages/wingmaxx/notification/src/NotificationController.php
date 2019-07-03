<?php

namespace Wingmaxx\Notification;
use DB;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Wingmaxx\Notification\Notification;

class NotificationController extends Controller
{
    public function index(){
        $data=Notification::whereBetween(DB::raw('NOW()'),[DB::raw('startdate'),DB::raw('enddate')])->get();
        if (count($data) > 0) {
            return view('notification::notiication',compact('data'));
        }
    }
}
