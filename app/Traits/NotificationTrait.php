<?php

namespace App\Traits;
use App\Models\Notification;
use Auth;

trait NotificationTrait{

    private function createNotification($title,$description,$path,$event_type){

        $notificationData = [
            'notification_for'=>Auth::user()->id,
            'title'=>$title,
            'description'=>$description,
            'is_read'=>0,
            'event_type'=>$event_type,
            'path_id'=>$path,
            'created_by'=>Auth::user()->id,
           'status'=>1,
        ];

        return Notification::create($notificationData);
    }
}
