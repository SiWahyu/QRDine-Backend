<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function __construct(
        private readonly PaymentService $paymentService
    ) {}

    public function notification(Request $request)
    {

        Log::info('MIDTRANS NOTIFICATION', $request->all());


        $this->paymentService->handleNotification($request->all());

        return response()->json([
            'message' => 'Notification handled successfully.',
        ]);
    }

    public function createPayment(string $orderNumber)
    {

        $order = Order::where(
            'order_number',
            $orderNumber
        )->firstOrFail();

        if ($order->payment_method !== 'online') {
            abort(422, 'This order does not use online payment.');
        }

        if ($order->payment_status !== 'pending') {
            abort(422, 'Order payment has already been processed.');
        }
        $snapToken = $this->paymentService->createPayment($order);

        return response()->json([
            'message' => 'Payment created successfully.',
            'data' => [
                'snap_token' => $snapToken
            ]
        ]);
    }
}
