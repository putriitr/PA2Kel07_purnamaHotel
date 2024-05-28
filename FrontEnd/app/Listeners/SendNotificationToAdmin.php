<?php

namespace App\Listeners;

use App\Models\Customer;
use App\Models\Payment;
use App\Notifications\OffersNotification;
use App\Notifications\PaymentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAdmin
{
    public function handle($event): void
    {
        $admin = Customer::whereHas('name', function($query){
            $query->where('id', 1);
        })->get();

        Notification::send($admin, new OffersNotification($event->name));
    }
}
