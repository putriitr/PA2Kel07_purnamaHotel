<?php

namespace App\Listeners;

use App\Models\Payment;
use App\Notifications\ApprovePaymentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNotificationApprove
{
    public function handle($event): void
    {
        // Mendapatkan pembayaran yang telah disetujui
        $approvedPayments = Payment::where('status', 'approved')->get();

        foreach ($approvedPayments as $payment) {
            // Mengirim notifikasi hanya jika pembayaran telah disetujui
            $paymentOwner = $payment->customer;
            $paymentOwner->notify(new ApprovePaymentNotification($payment));
        }
    }
}
