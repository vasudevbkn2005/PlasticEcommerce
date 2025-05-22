<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            background: #f6f9fc;
            margin: 0;
            padding: 40px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .invoice-box {
            width: 100%;
            max-width: 800px;
            padding: 30px 40px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        /* Company Header */
        .company-header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 12px;
        }

        .company-name {
            font-size: 30px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 5px;
        }

        .company-details {
            font-size: 14px;
            color: #555;
        }

        h2 {
            text-align: center;
            color: #0d6efd;
            margin-bottom: 10px;
            font-size: 22px;
        }

        .status-badge {
            display: block;
            text-align: center;
            margin: 0 auto 25px auto;
            padding: 6px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            border-radius: 25px;
            width: fit-content;
        }

        .status-pending { background-color: #ffc107; }
        .status-completed { background-color: #198754; }
        .status-cancelled { background-color: #dc3545; }
        .status-processing { background-color: #0d6efd; }

        .info {
            margin-bottom: 20px;
            font-size: 14px;
        }

        .info p {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #0d6efd;
            color: #fff;
        }

        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .product-image {
            width: 60px;
            height: auto;
            border-radius: 5px;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="company-header">
            <div class="company-name">Your Company Name</div>
            <div class="company-details">
                1234 Street Name, City, State, ZIP Code<br>
                Phone: +91 12345 67890 | Email: info@yourcompany.com<br>
                Website: www.yourcompany.com
            </div>
        </div>

        <h2>Invoice #{{ $order->id }}</h2>

        <div class="status-badge status-{{ strtolower($order->status) }}">
            {{ ucfirst($order->status) }}
        </div>

        <div class="info">
            <p><strong>Name:</strong> {{ $order->fullName }}</p>
            <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }} - {{ $order->pin }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($order->items as $item)
                    @php $lineTotal = $item->price * $item->quantity; $grandTotal += $lineTotal; @endphp
                    <tr>
                        <td>
                            <img src="{{ public_path('storage/' . $item->product->mimage) }}" class="product-image" alt="Product Image">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($lineTotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Grand Total: ₹{{ number_format($grandTotal, 2) }}</p>

        <div class="footer">
            Thank you for shopping with us!
        </div>
    </div>
</body>
</html>
