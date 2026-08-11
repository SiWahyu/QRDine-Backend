<?php

namespace App\Jobs;

use App\Mail\OrderReceiptMail;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOrderReceiptJob implements ShouldQueue
{
    use Queueable;


    public function __construct(public int $orderId) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order = Order::with([
            'table',
            'items.menu',
        ])->findOrFail($this->orderId);


        Mail::to($order->customer_email)
            ->send(new OrderReceiptMail($order));
    }
}
