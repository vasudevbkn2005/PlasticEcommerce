@extends('layouts.main')

@section('content')
    <style>
        .order-section {
            padding: 30px 15px;
            max-width: 1200px;
            margin: auto;
        }

        .status-container {
            background: linear-gradient(135deg, #ffffff, #f5f7fa);
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 45px;
            transition: all 0.3s ease;
        }

        .status-container:hover {
            transform: translateY(-6px);
        }

        .order-message-badge {
            padding: 12px 18px;
            font-weight: 600;
            display: inline-block;
            border-radius: 8px;
            margin-top: 10px;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .shipping-details {
            margin-top: 25px;
            text-align: left;
            font-size: 15px;
        }

        .product-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
            gap: 20px;
        }

        .product-item {
            display: flex;
            flex-direction: row;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.07);
            align-items: center;
            flex: 1 1 100%;
            gap: 25px;
        }

        .product-image img {
            width: 150px;
            height: auto;
            border-radius: 6px;
            object-fit: contain;
        }

        .product-info {
            flex: 1;
        }

        .product-info h5 {
            color: #c69500;
            font-weight: bold;
            font-size: 18px;
        }

        .product-price .strike-text {
            text-decoration: line-through;
            color: #d9534f;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 18px;
            font-weight: 600;
            border-radius: 6px;
        }

        @media (max-width: 768px) {
            .product-item {
                flex-direction: column;
                text-align: center;
                padding: 15px;
            }

            .product-image img {
                margin-bottom: 12px;
            }

            .shipping-details {
                font-size: 14px;
            }

            .button-group {
                flex-direction: column;
            }
        }

        .container.order-section {
            padding: 20px;
            width: 100%;
        }

        .status-container {
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            padding: 40px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .status-container:hover {
            transform: translateY(-5px);
        }

        .order-message-badge {
            padding: 10px;
            font-weight: 600;
            text-align: center;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .shipping-details {
            margin-top: 20px;
            text-align: left;
        }

        .product-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 30px;
        }

        .product-item {
            display: flex;
            background: white;
            padding: 25px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
        }

        .product-image img {
            width: 160px;
            height: auto;
            margin-right: 25px;
        }

        .product-info {
            text-align: left;
        }

        .product-info h5 {
            color: goldenrod;
            font-weight: bold;
        }

        .product-price .strike-text {
            text-decoration: line-through;
            color: red;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 35px;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 768px) {
            .product-item {
                flex-direction: column;
                text-align: center;
            }

            .product-image img {
                margin: 0 auto 14px;
            }

            .button-group {
                flex-direction: column;
            }
        }

        .shipping-details {
            background: #fefefe;
            border-left: 5px solid #0d6efd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .shipping-details:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .shipping-details p {
            font-size: 15px;
            margin-bottom: 10px;
        }

        .product-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="container order-section">
        <h2 class="text-center p-4 text-info">My Orders</h2>
        {{-- @dd($orders) --}}
        @if ($orders->isEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="order-message-badge badge-pending">
                        You have not placed any orders yet.
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <a href="/home" class="btn btn-outline-dark">
                            <i class="fas fa-shopping-cart"></i> Start Shopping Now
                        </a>
                    </div>
                </div>
            </div>
        @else
            @foreach ($orders as $order)
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="status-container">
                            <div class="order-info-box">
                                <h5 class="text-success">Order Number: <span>#{{ $order->id }}</span></h5>
                                {{-- @dd($order->status) --}}
                                @php
                                    $status = ucfirst(strtolower($order->status));
                                @endphp

                                @if ($status === 'Pending')
                                    <div class="order-message-badge badge-pending">
                                        <i class="fas fa-hourglass-half"></i> Thanks for your order! Our team is reviewing
                                        it.
                                    </div>
                                @elseif ($status === 'Processing')
                                    <div class="order-message-badge badge-info text-primary bg-light">
                                        <i class="fas fa-cogs"></i> Your order is being processed.
                                    </div>
                                @elseif ($status === 'Shipped')
                                    <div class="order-message-badge badge-warning text-dark bg-warning-subtle">
                                        <i class="fas fa-shipping-fast"></i> Your order has been shipped!
                                    </div>
                                @elseif ($status === 'Delivered')
                                    <div class="order-message-badge badge-success bg-success text-white">
                                        <i class="fas fa-box-open"></i> Your order was delivered successfully!
                                    </div>
                                @elseif ($status === 'Cancelled')
                                    <div class="order-message-badge badge-secondary bg-secondary text-white">
                                        <i class="fas fa-ban"></i> Your order was cancelled.
                                    </div>
                                @elseif ($status === 'Rejected')
                                    <div class="order-message-badge badge-rejected">
                                        <i class="fas fa-times-circle"></i> Your order was not approved. Please contact
                                        support.
                                    </div>
                                @endif
                            </div>

                            <div class="shipping-details shadow-sm p-4 rounded bg-light mt-4 border">
                                <h5 class="text-center mb-4 text-primary">
                                    <i class="fas fa-shipping-fast me-2"></i> Shipping & Billing Address
                                </h5>
                                <p><i class="fas fa-user me-2 text-secondary"></i><strong>Name:</strong>
                                    {{ $order->fullName }}</p>
                                <p><i class="fas fa-phone-alt me-2 text-secondary"></i><strong>Mobile:</strong>
                                    {{ $order->mobile }}</p>
                                <p><i class="fas fa-map-marker-alt me-2 text-secondary"></i><strong>Address:</strong>
                                    {{ $order->address }}, {{ $order->city }} - {{ $order->pin }}</p>
                                <p><i class="fas fa-credit-card me-2 text-secondary"></i><strong>Payment Method:</strong>
                                    {{ ucfirst($order->payment_method) }}</p>
                            </div>


                            <h5 class="mt-5 mb-3 text-center text-primary">
                                <i class="fas fa-box-open me-2"></i> Product Details
                            </h5>

                            <div class="product-details d-flex flex-column gap-4">
                                @foreach ($order->items as $item)
                                    <div
                                        class="product-item d-flex flex-md-row flex-column align-items-start gap-4 p-3 bg-white rounded shadow-sm border">
                                        <div class="product-image">
                                            <img src="{{ $item->product->mimage ? asset('storage/' . $item->product->mimage) : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg' }}"
                                                alt="{{ $item->product->mimage }}" class="img-fluid rounded"
                                                style="width: 160px;">
                                        </div>

                                        <div class="product-info flex-grow-1">
                                            <h5 class="text-dark">{{ $item->product->name }}</h5>
                                            <p class="mb-1 text-muted">M.R.P.:
                                                <span
                                                    class="text-decoration-line-through text-danger">₹{{ $item->product->prices->first()->price ?? 'N/A' }}</span>
                                            </p>
                                            <p class="mb-1"><strong
                                                    class="text-success">{{ $item->product->prices->first()->discount ?? '0' }}%
                                                    Off</strong></p>
                                            <p class="mb-1"><strong>Final Price:</strong> ₹{{ $item->price }} ×
                                                <strong>Qty:</strong> {{ $item->quantity }}
                                            </p>
                                            <p class="mb-0 fw-bold text-success">Grand Total:
                                                ₹{{ $item->price * $item->quantity }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="button-group d-flex justify-content-center gap-3 mt-5 flex-wrap">
                                <a href="{{ route('invoice.download', $order->id) }}"
                                    class="btn btn-outline-info shadow-sm">
                                    <i class="fas fa-download me-1"></i> Download Invoice
                                </a>
                                <a href="/home" class="btn btn-warning shadow-sm">
                                    <i class="fas fa-shopping-cart me-1"></i> Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
