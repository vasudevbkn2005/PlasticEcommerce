    @extends('layouts.main')

    @section('content')
        <style>
            @media (min-width: 768px) {
                .mobile-only {
                    display: none !important;
                }
            }

            .min-warning {
                display: flex;
                background: #e3f2fd;
                /* Light Blue */
                color: #1565c0;
                /* Dark Blue */
                border: 1px solid #90caf9;
                border-radius: 10px;
                padding: 15px 20px;
                margin-bottom: 20px;
                box-shadow: 0 2px 8px rgba(25, 118, 210, 0.15);
                align-items: center;
                font-family: 'Segoe UI', sans-serif;
            }

            .min-warning-icon {
                font-size: 24px;
                margin-right: 15px;
                flex-shrink: 0;
                color: #1976d2;
            }

            .min-warning-content {
                flex: 1;
            }

            .min-warning-text {
                font-size: 16px;
                margin-bottom: 10px;
                font-weight: 600;
                color: #0d47a1;
            }

            .progress-bar-wrapper {
                background-color: #bbdefb;
                border-radius: 20px;
                height: 10px;
                overflow: hidden;
                margin-bottom: 8px;
            }

            .progress-bar-bg {
                background-color: #e3f2fd;
                height: 100%;
                border-radius: 20px;
                position: relative;
            }

            .progress-bar-fill {
                height: 100%;
                background-color: #1976d2;
                transition: width 0.4s ease;
            }

            .min-warning-info {
                font-size: 14px;
                color: #0d47a1;
            }

            /* Responsive visibility classes */
            @media (max-width: 767px) {
                .desktop-only {
                    display: none !important;
                }

                .cart-container {
                    background: #fff;
                    border-radius: 10px;
                    padding: 20px;
                    box-shadow: 0 0 10px rgba(25, 118, 210, 0.1);
                }

                .cart-heading {
                    color: #1976d2;
                    font-weight: bold;
                    margin-bottom: 20px;
                }

                .cart-table th,
                .cart-table td {
                    font-size: 14px;
                    vertical-align: middle;
                }

                .cart-table img {
                    width: 100px;
                    height: 100px;
                    object-fit: cover;
                    border-radius: 8px;
                    border: 1px solid #90caf9;
                }

                .quantity-input {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    max-width: 120px;
                    border: 1px solid #90caf9;
                    border-radius: 6px;
                    overflow: hidden;
                }

                .quantity-input button {
                    background-color: #e3f2fd;
                    color: #1976d2;
                    border: none;
                    font-size: 18px;
                    width: 32px;
                    height: 32px;
                    cursor: pointer;
                }

                .quantity-input button:hover {
                    background-color: #1976d2;
                    color: white;
                }

                .quantity-input input[type="number"] {
                    width: 40px;
                    text-align: center;
                    border: none;
                    font-size: 16px;
                    padding: 5px;
                    outline: none;
                    color: #0d47a1;
                }

                .remove-btn {
                    background-color: #e53935;
                    color: white;
                    border: none;
                    padding: 6px 12px;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 14px;
                }

                .remove-btn:hover {
                    background-color: #c62828;
                }
            }
        </style>

        <style>
            .cart-page {
                font-family: 'Segoe UI', sans-serif;
                background-color: #f9fbfe;
                /* very light blue */
                padding-bottom: 40px;
            }

            .cart-page .cart-container {
                max-width: 1200px;
                margin: 40px auto;
                display: flex;
                gap: 24px;
                padding: 0 16px;
                flex-wrap: wrap;
            }

            .cart-page .cart-left,
            .cart-page .cart-right {
                background: #fff;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 4px 12px rgba(25, 118, 210, 0.15);
            }

            .cart-page .cart-left {
                flex: 2;
            }

            .cart-page .cart-right {
                flex: 1;
                height: fit-content;
                min-width: 280px;
            }

            .cart-page .warning {
                background-color: #e3f2fd;
                /* light blue */
                color: #1565c0;
                /* darker blue */
                padding: 14px 18px;
                margin-bottom: 24px;
                border-radius: 8px;
                font-weight: 600;
                border: 1px solid #90caf9;
            }

            .cart-page .progress-bar-container {
                background-color: #bbdefb;
                border-radius: 6px;
                height: 8px;
                overflow: hidden;
                margin-top: 8px;
            }

            .cart-page .progress-bar {
                height: 100%;
                background-color: #1976d2;
            }

            .cart-page table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                border-radius: 8px;
                overflow: hidden;
                min-width: 700px;
            }

            .cart-page thead th {
                background-color: #e3f2fd;
                text-align: left;
                padding: 12px;
                position: sticky;
                top: 0;
                z-index: 1;
                color: #1565c0;
            }

            .cart-page tbody td {
                padding: 12px;
                border-bottom: 1px solid #e0e0e0;
                vertical-align: top;
                color: #0d47a1;
            }

            .cart-page tbody tr:hover {
                background-color: #f1f8ff;
            }

            .cart-page img {
                width: 80px;
                height: 80px;
                object-fit: cover;
                border-radius: 6px;
                border: 1px solid #90caf9;
            }

            .cart-page select {
                padding: 4px 8px;
                font-size: 14px;
                border: 1px solid #90caf9;
                border-radius: 4px;
                color: #0d47a1;
            }

            .cart-page .cart-actions button {
                background-color: transparent;
                color: #1976d2;
                border: 1px solid #1976d2;
                padding: 6px 10px;
                border-radius: 4px;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.2s ease-in-out;
                margin-bottom: 6px;
            }

            .cart-page .cart-actions button:hover {
                background-color: #1976d2;
                color: white;
            }

            .cart-page .cart-actions .remove-btn {
                border-color: #1565c0;
                color: #1565c0;
            }

            .cart-page .cart-actions .remove-btn:hover {
                background-color: #1565c0;
                color: white;
            }

            .cart-page .pincode,
            .cart-page .coupon-box {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 16px;
                background-color: #e3f2fd;
                border: 1px dashed #90caf9;
                border-radius: 6px;
                margin-bottom: 20px;
                cursor: pointer;
                color: #1565c0;
            }

            .cart-page .coupon-input {
                display: none;
                margin-bottom: 20px;
            }

            .cart-page .coupon-input input {
                width: 100%;
                padding: 10px;
                border: 1px solid #90caf9;
                border-radius: 6px;
                margin-top: 8px;
                color: #0d47a1;
            }

            .cart-page .summary {
                font-size: 16px;
                margin-bottom: 24px;
                color: #0d47a1;
            }

            .cart-page .summary-item {
                display: flex;
                justify-content: space-between;
                margin-bottom: 12px;
                font-size: 15px;
                color: #1565c0;
            }

            .cart-page .summary-item.total {
                font-weight: 700;
                font-size: 16px;
                color: #0d47a1;
            }

            .cart-page .saved-msg {
                background-color: #e3fcef;
                color: #2e7d32;
                padding: 10px;
                text-align: center;
                border-radius: 6px;
                font-size: 14px;
                margin-bottom: 14px;
            }

            .cart-page .checkout-button {
                width: 100%;
                background-color: #1976d2;
                color: #fff;
                padding: 14px;
                font-size: 16px;
                font-weight: bold;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .cart-page .checkout-button:hover {
                background-color: #1565c0;
            }

            .cart-page .quantity-input {
                display: flex;
                align-items: center;
                border: 1px solid #90caf9;
                border-radius: 8px;
                overflow: hidden;
                width: 110px;
                background-color: #fff;
                box-shadow: 0 1px 3px rgba(25, 118, 210, 0.1);
            }

            .cart-page .quantity-input input {
                width: 50px;
                text-align: center;
                border: none;
                outline: none;
                font-size: 16px;
                font-weight: 600;
                color: #0d47a1;
            }

            .cart-page .quantity-input button {
                background-color: #e3f2fd;
                border: none;
                width: 36px;
                height: 36px;
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.25s ease;
                display: flex;
                justify-content: center;
                align-items: center;
                user-select: none;
                color: #1976d2;
            }

            .cart-page .quantity-input button:hover {
                color: white;
                background-color: #1976d2;
                box-shadow: 0 0 8px rgba(25, 118, 210, 0.6);
                border-radius: 50%;
            }

            .cart-page .quantity-input button:active {
                color: white;
                box-shadow: none;
                border-radius: 50%;
            }

            .cart-page .quantity-input input::-webkit-outer-spin-button,
            .cart-page .quantity-input input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .cart-page .quantity-input input[type=number] {
                -moz-appearance: textfield;
            }

            /* Responsive unchanged */
            @media (max-width: 768px) {
                .cart-page .cart-container {
                    flex-direction: column;
                    padding: 0 12px;
                    margin: 20px auto;
                }

                .cart-page table {
                    min-width: 100%;
                    overflow-x: auto;
                    display: block;
                }

                .cart-page thead {
                    display: none;
                }

                .cart-page tbody tr {
                    display: block;
                    margin-bottom: 20px;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 12px;
                    background: #fff;
                }

                .cart-page tbody td {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px 0;
                    border-bottom: none;
                    font-size: 14px;
                    color: #0d47a1;
                }

                .cart-page tbody td:last-child {
                    justify-content: flex-end;
                }

                .cart-page tbody td::before {
                    content: attr(data-label);
                    font-weight: 600;
                    color: #1565c0;
                    flex-basis: 50%;
                }

                .cart-page .cart-left,
                .cart-page .cart-right {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .cart-page .quantity-input {
                    width: 100px;
                }

                .cart-page .checkout-button {
                    font-size: 18px;
                    padding: 16px;
                }
            }

            @media (max-width: 768px) {
                .desktop-only {
                    display: none !important;
                }
            }

            .cart-heading {
                font-family: 'Segoe UI', sans-serif;
                font-size: 28px;
                font-weight: 700;
                color: #1976d2;
                position: relative;
                margin: 0 auto 30px;
                padding-bottom: 10px;
                display: table;
                text-align: center;
            }

            .cart-heading::after {
                content: '';
                display: block;
                width: 60px;
                height: 4px;
                margin: 10px auto 0;
                background: linear-gradient(90deg, #42a5f5, #1976d2);
                border-radius: 2px;
            }
        </style>
        {{-- <style>
            .cart-page {
                font-family: 'Segoe UI', sans-serif;
                background-color: #f3f4f6;
                padding-bottom: 40px;
            }

            .cart-page .cart-container {
                max-width: 1200px;
                margin: 40px auto;
                display: flex;
                gap: 24px;
                padding: 0 16px;
                flex-wrap: wrap;
            }

            .cart-page .cart-left,
            .cart-page .cart-right {
                background: #fff;
                border-radius: 12px;
                padding: 24px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .cart-page .cart-left {
                flex: 2;
            }

            .cart-page .cart-right {
                flex: 1;
                height: fit-content;
                min-width: 280px;
            }

            .cart-page .warning {
                background-color: #fff3f3;
                color: #d32f2f;
                padding: 14px 18px;
                margin-bottom: 24px;
                border-radius: 8px;
                font-weight: 600;
                border: 1px solid #fbcaca;
            }

            .cart-page .progress-bar-container {
                background-color: #ffe5e5;
                border-radius: 6px;
                height: 8px;
                overflow: hidden;
                margin-top: 8px;
            }

            .cart-page .progress-bar {
                height: 100%;
                background-color: #f44336;
            }

            .cart-page table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                border-radius: 8px;
                overflow: hidden;
                min-width: 700px;
            }

            .cart-page thead th {
                background-color: #f3f4f6;
                text-align: left;
                padding: 12px;
                position: sticky;
                top: 0;
                z-index: 1;
            }

            .cart-page tbody td {
                padding: 12px;
                border-bottom: 1px solid #e0e0e0;
                vertical-align: top;
            }

            .cart-page tbody tr:hover {
                background-color: #f9fafb;
            }

            .cart-page img {
                width: 80px;
                height: 80px;
                object-fit: cover;
                border-radius: 6px;
            }

            .cart-page select {
                padding: 4px 8px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .cart-page .cart-actions button {
                background-color: transparent;
                color: #1976d2;
                border: 1px solid #1976d2;
                padding: 6px 10px;
                border-radius: 4px;
                font-size: 14px;
                cursor: pointer;
                transition: all 0.2s ease-in-out;
                margin-bottom: 6px;
            }

            .cart-page .cart-actions button:hover {
                background-color: #1976d2;
                color: white;
            }

            .cart-page .cart-actions .remove-btn {
                border-color: #d32f2f;
                color: #d32f2f;
            }

            .cart-page .cart-actions .remove-btn:hover {
                background-color: #d32f2f;
                color: white;
            }

            .cart-page .pincode,
            .cart-page .coupon-box {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 16px;
                background-color: #f9fafb;
                border: 1px dashed #ccc;
                border-radius: 6px;
                margin-bottom: 20px;
                cursor: pointer;
            }

            .cart-page .coupon-input {
                display: none;
                margin-bottom: 20px;
            }

            .cart-page .coupon-input input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 6px;
                margin-top: 8px;
            }

            .cart-page .summary {
                font-size: 16px;
                margin-bottom: 24px;
            }

            .cart-page .summary-item {
                display: flex;
                justify-content: space-between;
                margin-bottom: 12px;
                font-size: 15px;
                color: #555;
            }

            .cart-page .summary-item.total {
                font-weight: 700;
                font-size: 16px;
                color: #111;
            }

            .cart-page .saved-msg {
                background-color: #e8f5e9;
                color: #2e7d32;
                padding: 10px;
                text-align: center;
                border-radius: 6px;
                font-size: 14px;
                margin-bottom: 14px;
            }

            .cart-page .checkout-button {
                width: 100%;
                background-color: #ff7043;
                color: #fff;
                padding: 14px;
                font-size: 16px;
                font-weight: bold;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .cart-page .checkout-button:hover {
                background-color: #f4511e;
            }

            .cart-page .quantity-input {
                display: flex;
                align-items: center;
                border: 1px solid #ccc;
                border-radius: 8px;
                overflow: hidden;
                width: 110px;
                background-color: #fff;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }

            .cart-page .quantity-input input {
                width: 50px;
                text-align: center;
                border: none;
                outline: none;
                font-size: 16px;
                font-weight: 600;
                color: #333;
            }

            .cart-page .quantity-input button {
                background-color: #f5f5f5;
                border: none;
                width: 36px;
                height: 36px;
                font-size: 20px;
                font-weight: bold;
                cursor: pointer;
                transition: background-color 0.25s ease;
                display: flex;
                justify-content: center;
                align-items: center;
                user-select: none;
            }

            .cart-page .quantity-input button:hover {
                color: #fff;
                box-shadow: 0 0 8px rgba(255, 112, 67, 0.6);
                border-radius: 50%;
            }

            .cart-page .quantity-input button:active {
                color: #fff;
                box-shadow: none;
                border-radius: 50%;
            }

            /* Hide arrows on number input */
            .cart-page .quantity-input input::-webkit-outer-spin-button,
            .cart-page .quantity-input input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .cart-page .quantity-input input[type=number] {
                -moz-appearance: textfield;
            }

            @media (max-width: 768px) {
                .cart-page .cart-container {
                    flex-direction: column;
                    padding: 0 12px;
                    margin: 20px auto;
                }

                .cart-page table {
                    min-width: 100%;
                    overflow-x: auto;
                    display: block;
                }

                .cart-page thead {
                    display: none;
                }

                .cart-page tbody tr {
                    display: block;
                    margin-bottom: 20px;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 12px;
                    background: #fff;
                }

                .cart-page tbody td {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px 0;
                    border-bottom: none;
                    font-size: 14px;
                }

                .cart-page tbody td:last-child {
                    justify-content: flex-end;
                }

                .cart-page tbody td::before {
                    content: attr(data-label);
                    font-weight: 600;
                    color: #555;
                    flex-basis: 50%;
                }

                .cart-page .cart-left,
                .cart-page .cart-right {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .cart-page .quantity-input {
                    width: 100px;
                }

                .cart-page .checkout-button {
                    font-size: 18px;
                    padding: 16px;
                }
            }
        </style> --}}

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-12 cart-container">
                    <h3 class="cart-heading">
                        🛒 Shopping Cart
                    </h3>

                    <div class="mobile-only">
                        @if ($cartTotal < 500)
                            <div class="min-warning">
                                <div class="min-warning-icon">⚠</div>
                                <div class="min-warning-content">
                                    <div class="min-warning-text">
                                        <strong>Minimum Order Amount is ₹500</strong>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-bg">
                                            <div class="progress-bar-fill"
                                                style="width: {{ min(100, ($cartTotal / 500) * 100) }}%"></div>
                                        </div>
                                    </div>
                                    <div class="min-warning-info">
                                        Add ₹{{ number_format(500 - $cartTotal, 2) }} more to checkout
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table cart-table mt-4">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Details</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cartItems as $item)
                                        @php
                                            $product = $item->product;
                                            $price = $product->prices->first();

                                            // Find applicable bulk price for this quantity
                                            $bulks = \App\Models\Bulk::where('product_id', $product->id)
                                                //->where('user_id', auth()->id()) // optional user filter
                                                ->get()
                                                ->where('bulk_order_quantity', '<=', $item->quantity)
                                                ->sortByDesc('bulk_order_quantity');

                                            $bulk = $bulks->first();

                                            $unitPrice = $bulk ? $bulk->price : $price->final_price;

                                            $finalPrice = $unitPrice * $item->quantity;
                                            $originalPrice = $price->price * $item->quantity;
                                            $discount = $price->discount;
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="/product/{{ $product->id }}">
                                                    <img src="{{ $product->mimage ? asset('storage/' . $product->mimage) : 'https://dummyimage.com/100x100/dee2e6/6c757d.jpg' }} "
                                                        height="150px" width="150px" alt="{{ $product->name }}">
                                                </a>
                                            </td>
                                            <td>
                                                <strong>{{ $product->name }}</strong><br>
                                                @if ($bulk)
                                                    <span
                                                        style="text-decoration: line-through; color: #888;">₹{{ number_format($price->final_price, 2) }}</span>
                                                    <span
                                                        style="color: #2e7d32; font-weight: 600; margin-left: 6px;">₹{{ number_format($unitPrice, 2) }}</span><br>
                                                    <small style="color: #388e3c;">Bulk price applied (min
                                                        {{ $bulk->bulk_order_quantity }})</small>
                                                @else
                                                    <span style="color: #2e7d32;">₹{{ number_format($unitPrice, 2) }}</span>
                                                @endif
                                                <del
                                                    style="margin-left: 6px; color: #888;">₹{{ number_format($price->price, 2) }}</del>
                                                <span style="margin-left: 6px; color: #388e3c;">({{ $discount }}%
                                                    Off)</span>
                                            </td>
                                            <td>
                                                <div class="quantity-input" data-id="{{ $item->product->id }}">
                                                    <button type="button" class="decrease">−</button>
                                                    <input type="number" min="1" value="{{ $item->quantity }}" />
                                                    <button type="button" class="increase">+</button>
                                                </div>
                                            </td>
                                            <td>
                                                ₹{{ number_format($finalPrice, 2) }}
                                            </td>
                                            <td class="cart-actions">
                                                <form method="POST" action="{{ route('cart.remove') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $item->product_id }}">
                                                    <button type="submit" class="remove-btn">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center; padding: 20px;">
                                                Your cart is empty.<br>
                                                <a href="/" style="display: inline-block; margin-top: 10px;"
                                                    class="btn btn-success">
                                                    Continue Shopping
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>




        <div class="cart-page">
            <div class="cart-container">
                <!-- Left Section -->
                <div class="cart-left desktop-only">
                    @if ($cartTotal < 500)
                        <div class="warning">
                            ⚠ Minimum Order Amount is ₹500
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ ($cartTotal / 500) * 100 }}%"></div>
                            </div>
                            <small>Add ₹{{ number_format(500 - $cartTotal, 2) }} more to checkout</small>
                        </div>
                    @endif

                    <table class="desktop-only">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Details</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItems as $item)
                                @php
                                    $product = $item->product;
                                    $price = $product->prices->first();

                                    // Find applicable bulk price for this quantity
                                    $bulks = \App\Models\Bulk::where('product_id', $product->id)
                                        //->where('user_id', auth()->id()) // optional user filter
                                        ->get()
                                        ->where('bulk_order_quantity', '<=', $item->quantity)
                                        ->sortByDesc('bulk_order_quantity');

                                    $bulk = $bulks->first();

                                    $unitPrice = $bulk ? $bulk->price : $price->final_price;

                                    $finalPrice = $unitPrice * $item->quantity;
                                    $originalPrice = $price->price * $item->quantity;
                                    $discount = $price->discount;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="/product/{{ $product->id }}">
                                            <img src="{{ $product->mimage ? asset('storage/' . $product->mimage) : 'https://dummyimage.com/100x100/dee2e6/6c757d.jpg' }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </td>
                                    <td>
                                        <strong>{{ $product->name }}</strong><br>
                                        @if ($bulk)
                                            <span
                                                style="text-decoration: line-through; color: #888;">₹{{ number_format($price->final_price, 2) }}</span>
                                            <span
                                                style="color: #2e7d32; font-weight: 600; margin-left: 6px;">₹{{ number_format($unitPrice, 2) }}</span><br>
                                            <small style="color: #388e3c;">Bulk price applied (min
                                                {{ $bulk->bulk_order_quantity }})</small>
                                        @else
                                            <span style="color: #2e7d32;">₹{{ number_format($unitPrice, 2) }}</span>
                                        @endif
                                        <del
                                            style="margin-left: 6px; color: #888;">₹{{ number_format($price->price, 2) }}</del>
                                        <span style="margin-left: 6px; color: #388e3c;">({{ $discount }}% Off)</span>
                                    </td>
                                    <td>
                                        <div class="quantity-input" data-id="{{ $item->product->id }}">
                                            <button type="button" class="decrease">−</button>
                                            <input type="number" min="1" value="{{ $item->quantity }}" />
                                            <button type="button" class="increase">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        ₹{{ number_format($finalPrice, 2) }}
                                    </td>
                                    <td class="cart-actions">
                                        <form method="POST" action="{{ route('cart.remove') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <button type="submit" class="remove-btn">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 20px;">
                                        Your cart is empty.<br>
                                        <a href="/" style="display: inline-block; margin-top: 10px;"
                                            class="btn btn-success">
                                            Continue Shopping
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Mobile Only --}}

                </div>


                <!-- Right Section -->
                <div class="cart-right">
                    {{-- <div class="pincode">
                    <span>Enter Delivery Pincode</span>
                    <button>ADD</button>
                </div>

                <div class="coupon-box" onclick="toggleCouponInput()">
                    <span>Apply Coupon</span>
                    <span>+</span>
                </div>
                <div id="coupon-input" class="coupon-input">
                    <input type="text" placeholder="Enter coupon code">
                </div> --}}

                    <div class="summary">
                        <div class="summary-item">
                            <span>🛍 Item(s) Total</span>
                            <span>₹{{ number_format($cartOriginalTotal, 2) }}</span>
                        </div>
                        <div class="summary-item">
                            <span>🚚 Delivery</span>
                            <span>Free</span>
                        </div>
                        @foreach ($gstAmounts as $g)
                            <div class="summary-item">
                                <span>GST</span>
                                <span>{{ number_format($g, 2) }}</span>
                            </div>
                            <div class="summary-item total">
                                <span>Total Amount</span>
                                <span>₹{{ number_format($cartTotal + $g, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    @if ($savedAmount > 0)
                        <div class="saved-msg">
                            ✅ You saved ₹{{ number_format($savedAmount, 2) }} on this order!
                        </div>
                    @endif

                    <button onclick="checkout()" class="checkout-button"
                        {{ $cartTotal < 500 ? 'disabled style=opacity:0.6;cursor:not-allowed;' : '' }}>
                        PROCEED TO CHECKOUT
                    </button>
                </div>
                <a href="/" style="display: inline-block; margin-top: 10px;" class="btn btn-info">
                    Shopping
                </a>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function checkout() {
                const cartTotal = {{ $cartTotal }};
                if (cartTotal < 500) {
                    alert("Minimum order amount is ₹500 to proceed to checkout.");
                    return;
                }
                window.location.href = "{{ route('checkout.index') }}";
            }

            function updateCartQuantity(productId, quantity) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('cart.add') }}",
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        update: true,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // alert('Quantity updated!');
                        location.reload(); // reload page to reflect cart changes
                    },
                    error: function(xhr) {
                        alert('Error updating cart: ' + xhr.responseText);
                    }
                });
            }

            function toggleCouponInput() {
                const input = document.getElementById('coupon-input');
                input.style.display = input.style.display === 'none' ? 'block' : 'none';
            }
            $(document).on('click', '.quantity-input .increase, .quantity-input .decrease', function() {
                const parent = $(this).closest('.quantity-input');
                const input = parent.find('input');
                let value = parseInt(input.val());
                const productId = parent.data('id');

                if ($(this).hasClass('increase')) value++;
                if ($(this).hasClass('decrease') && value > 1) value--;

                input.val(value);
                updateCartQuantity(productId, value);
            });

            $(document).on('change', '.quantity-input input', function() {
                let value = parseInt($(this).val());
                if (value < 1) value = 1;
                // Optionally set max limit or remove it:
                // if (value > 100) value = 100;  // example max 100
                $(this).val(value);
                const productId = $(this).closest('.quantity-input').data('id');
                updateCartQuantity(productId, value);
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @endsection
