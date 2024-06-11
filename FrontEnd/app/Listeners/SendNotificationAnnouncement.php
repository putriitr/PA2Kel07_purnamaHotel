<?php

namespace App\Listeners;

use App\Models\Announcement;
use App\Notifications\AnnouncementNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationAnnouncement
{
    public function handle($event): void
    {
        $customer = Announcement::whereHas('nama', function($query){
            $query->where('id', 1);
        })->get();

        Notification::send($customer, new AnnouncementNotification($event->value));
    }
}
