<?php

namespace App\Http\Controllers;
use App\Models\DriverNotification;
use Auth;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function checkDriverNotification(Request $request)
    {
        $driver =  Auth::user()->id;
        $notifications = DriverNotification::where('driver_id',$driver)->get();
        return response()->json(['notifications' => $notifications]);
    }
}
