<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\FileTrait;
use App\Traits\NotificationTrait;

class AvatarController extends Controller
{
    use FileTrait;
    use NotificationTrait;

    public function uploadAvatar(Request $request)
    {
        $file = $request->file('file');

        $upload = $this->uploadFile($file,'flat-', Auth::user());

        Auth::user()->avatar = $upload->id;
        Auth::user()->save();

        $title = 'Profile Picture has been Changed.';
        $description='You have Changed your profile picture. Stay connected.';
        $event_type =config('variables.EVENT_TYPE.profile_update');

        $this->createNotification($title,$description,Auth::user()->address_id,$event_type);

        return $upload;
    }
}
