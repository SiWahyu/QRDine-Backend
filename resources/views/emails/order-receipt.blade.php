<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Order Receipt - {{ $order->order_number }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            padding: 30px 15px;
            margin: 0;
        }

        .receipt {
            width: 280px;
            background: white;
            border: 2px dashed #ccc;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .shop-name {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            text-align: center;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

        .receipt hr {
            border: none;
            border-top: 1px dashed #ccc;
            margin: 12px 0;
        }

        .receipt table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 0.85rem;
        }

        .receipt table th,
        .receipt table td {
            padding: 4px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .receipt table th:nth-child(2),
        .receipt table td:nth-child(2) {
            text-align: center;
        }

        .receipt table th:nth-child(3),
        .receipt table td:nth-child(3) {
            text-align: right;
        }

        .summary p {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin: 4px 0;
        }

        .total {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .payment p {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin: 4px 0;
        }

        .thanks {
            font-size: 0.85rem;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="receipt">
        <p class="shop-name">QR Dine</p>
        <p class="info">
            Terima kasih atas pesanan Anda, {{ $order->customer_name }}!<br>
            No. Order: {{ $order->order_number }}<br>
            Meja: {{ $order->table->number }}
        </p>

        <hr>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <div class="summary">
            <p><span>Subtotal:</span> <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span></p>
            <p><span>Tax:</span> <span>Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span></p>
            <p><span>Service:</span> <span>Rp {{ number_format($order->service_amount, 0, ',', '.') }}</span></p>
        </div>

        <hr>

        <div class="total">
            <p>Total:</p>
            <p>Rp {{ number_format($order->total, 0, ',', '.') }}</p>
        </div>

        <div class="payment">
            <p><span>Payment Method:</span> <span>{{ ucfirst($order->payment_method) }}</span></p>
            <p><span>Payment Status:</span> <span>{{ ucfirst($order->payment_status) }}</span></p>
        </div>

        <p class="thanks">Sampai jumpa lagi di QR Dine!</p>
    </div>

</body>

</html>