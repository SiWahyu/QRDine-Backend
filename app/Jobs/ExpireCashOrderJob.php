<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExpireCashOrderJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->order->payment_status !== 'pending') {
            return;
        }

        $this->order->update([
            'status' => 'cancelled',
        ]);
    }
}
