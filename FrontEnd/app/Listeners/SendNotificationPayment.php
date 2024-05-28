<?php

namespace App\Listeners;

use App\Models\Payment;
use App\Notifications\PaymentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;

class SendNotificationPayment
{
    public function handle($event): void
    {
        $payment = $event->payment;

        // Retrieve the booking associated with the payment
        $booking = $payment->booking;

        // Retrieve the customer associated with the booking
        $customer = $booking ? $booking->customer : null;

        // Check if the customer exists
        if ($customer) {
            // Send the notification to the customer
            Notification::send($customer, new PaymentNotification($payment));
        }
    }
}
