<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notification ($id=null)
    {
        $notification = Notification::where('id', $id)->first();

        $notification->is_read = 1;
        $notification->read_at = date('Y-m-d H:i:s');

        $notification->save();

        return $notification;
    }
}
