@extends('layouts.main')

@section('content')
    <style>
        .container {
            max-width: 1200px;
            padding: 30px 20px;
        }

        h2 {
            color: #343a40;
            font-weight: bold;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 15px 15px 0 0;
            padding: 15px;
            font-weight: bold;
        }

        .card-body {
            padding: 25px;
        }

        .list-group-item {
            font-size: 1rem;
            padding: 15px;
            border: none;
            border-bottom: 1px solid #f1f1f1;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            font-weight: bold;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .form-check-label {
            font-weight: 500;
        }

        .form-check-input {
            border-radius: 50%;
        }

        #qrCodeContainer {
            position: relative;
            padding: 10px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 100%;
            margin-top: 20px;
            display: none;
        }

        #qrCodeContainer img {
            width: auto;
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        #qrCodeContainer h5 {
            margin-bottom: 10px;
            color: #28a745;
            font-weight: bold;
        }

        #uploadScreenshot {
            display: none;
            margin-top: 20px;
        }

        #uploadScreenshot input {
            padding: 10px;
        }

        #uploadScreenshot p {
            margin-top: 10px;
            color: #28a745;
            font-weight: bold;
        }

        @media (max-width: 767px) {
            #qrCodeContainer {
                max-width: 220px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .card-body {
                padding: 15px;
            }

            .form-control {
                font-size: 0.9rem;
            }
        }

        .bank-details-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            text-align: left;
            transition: all 0.3s ease-in-out;
        }

        .bank-details-box h6 {
            font-size: 1.1rem;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 12px;
        }

        .bank-details-box li {
            font-size: 0.95rem;
            margin-bottom: 6px;
        }

        @media (max-width: 767px) {
            .bank-details-box {
                padding: 15px;
            }

            .bank-details-box li {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 767px) {

            #qrCodeContainer,
            #bankDetails {
                text-align: center;
                width: 100%;
            }

            #bankDetails ul {
                text-align: left;
                display: inline-block;
            }

            #qrCodeImage {
                margin: 0 auto;
            }
        }
    </style>

    <div class="container my-5">
        <h2 class="text-center mb-4">Checkout</h2>
        @foreach ($errors->all() as $e)
            <span>{{ $e }}</span>
        @endforeach

        <form action="{{ route('place.order') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Billing Details -->
                <div class="col-12 col-md-4">
                    <div class="card shadow-lg mb-4">
                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="mb-0">Billing Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName"
                                    value="{{ old('fullName', $user->name) }}" placeholder="John Doe" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" placeholder="john@example.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    value="{{ old('mobile', $user->mobile) }}" placeholder="123-456-7890" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $user->address) }}" placeholder="1234 Main St" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ old('city', $user->city) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="pin" class="form-label">Pin Code</label>
                                <input type="text" class="form-control" id="pin" name="pin"
                                    value="{{ old('pin', $user->pin) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Code (Center) -->
                <div class="col-12 col-md-4 d-flex flex-column align-items-center text-center mx-auto">
                    <div id="bankDetails" class="bank-details-box mb-3" style="display: none;">
                        <h6>Bank Account Details</h6>
                        <ul class="list-unstyled mb-0 text-start">
                            <li><strong>Account Name:</strong> ABC Pvt Ltd</li>
                            <li><strong>Account Number:</strong> 1234567890</li>
                            <li><strong>IFSC Code:</strong> ABCD0123456</li>
                            <li><strong>Bank:</strong> XYZ Bank</li>
                        </ul>
                    </div>

                    <div id="qrCodeContainer">
                        <img src="../storage/download.png" alt="QR Code" id="qrCodeImage" class="img-fluid mb-2"
                            style="max-width: 200px;">
                        <h5>Scan to Pay</h5>
                        <div id="uploadScreenshot" class="mt-2">
                            <input type="file" id="screenshot" name="screenshot" class="form-control" accept="image/*">
                            <p class="mt-2">Upload the screenshot after payment. Then, click "Place Order".</p>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-12 col-md-4">
                    <div class="card shadow-lg mb-4">
                        <div class="card-header bg-success text-white rounded-top">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-3">
                                @foreach ($cart as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            {{ $item->product->name }} ({{ $item->quantity }})
                                            @if ($item->product->prices->first()->final_price != $item->calculated_price)
                                                <br><small class="text-success">Bulk Price Applied</small>
                                            @endif
                                        </div>
                                        <strong>
                                            {{ number_format($item->calculated_price * $item->quantity, 2) }}
                                        </strong>
                                    </li>
                                @endforeach
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>GST (18%)</span>
                                    <strong>{{ number_format($gst, 2) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>{{ number_format($finalTotal, 2) }}</strong>
                                </li>
                            </ul>

                            <h6 class="mb-3">Payment Method</h6>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="online"
                                    value="online" required>
                                <label class="form-check-label" for="online">Online Payment</label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                    value="cod" required>
                                <label class="form-check-label" for="cod">Cash on Delivery</label>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 mt-4 shadow-sm" id="placeOrderBtn">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const qrCodeContainer = document.getElementById("qrCodeContainer");
        const uploadScreenshot = document.getElementById("uploadScreenshot");
        const onlineRadio = document.getElementById("online");
        const codRadio = document.getElementById("cod");
        const screenshotInput = document.getElementById("screenshot");
        const placeOrderBtn = document.getElementById("placeOrderBtn");
        const bankDetails = document.getElementById("bankDetails");

        // Default state (enabled)
        placeOrderBtn.disabled = false;

        onlineRadio.addEventListener("click", function() {
            qrCodeContainer.style.display = "block";
            uploadScreenshot.style.display = "block";
            bankDetails.style.display = "block"; // Show bank details
            placeOrderBtn.disabled = true;
        });

        codRadio.addEventListener("click", function() {
            qrCodeContainer.style.display = "none";
            uploadScreenshot.style.display = "none";
            bankDetails.style.display = "none"; // Hide bank details
            placeOrderBtn.disabled = false;
        });

        screenshotInput.addEventListener("change", function() {
            placeOrderBtn.disabled = screenshotInput.files.length === 0;
        });
    </script>
@endsection
