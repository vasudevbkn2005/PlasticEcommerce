@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            <!-- Product Image & Cart -->
            <div class="col-md-6">
                <div class="card p-4 shadow-sm border-0">
                    <img src="{{ $product->mimage ? asset('storage/' . $product->mimage) : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg' }}"
                        alt="{{ $product->name }}" class="main-img img-fluid rounded mb-4" id="mainProductImage">

                    <div id="cartControls" class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                        @if ($quantityInCart > 0)
                            <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
                                <button class="btn btn-outline-danger btn-sm rounded-circle fw-bold"
                                    id="decreaseQty">−</button>
                                <input type="number" id="quantityCount" value="{{ $quantityInCart }}" min="1"
                                    class="form-control text-center" style="width: 60px;" />
                                <button class="btn btn-outline-success btn-sm rounded-circle fw-bold"
                                    id="increaseQty">+</button>
                            </div>
                        @else
                            <button onclick="addtocart({{ $product->id }})"
                                class="btn btn-success btn-md rounded-pill px-4 shadow-sm d-flex justify-content-center align-items-center gap-2 text-center"
                                id="addToCartBtn">
                                <i class="bi bi-cart-plus"></i> <span class="d-inline-block">Add to Cart</span>
                            </button>
                        @endif
                    </div>

                    <!-- Thumbnails -->
                    <div class="d-flex flex-row flex-wrap justify-content-center mt-4 gap-3">
                        @if ($product->mimage)
                            <img src="{{ asset('storage/' . $product->mimage) }}" alt="Main Image"
                                class="side-img img-thumbnail rounded shadow-sm">
                        @endif

                        @foreach ($product->otherImages as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Extra View"
                                class="side-img img-thumbnail rounded shadow-sm">
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <h2 class="fw-bold text-dark">{{ $product->name }}</h2>

                @php $price = optional($product->prices->first()); @endphp


                {{-- @if ($product->colors && count($product->colors))
                    <div class="mb-4">
                        <strong class="text-dark d-block mb-2">Available Colors:</strong>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($product->colors as $color)
                                <div class="color-option">
                                    <div class="color-box"
                                        @if (!$color->colorimage) style="background-color: {{ $color->color }};" @endif
                                        data-color="{{ $color->color }}">
                                        @if ($color->colorimage)
                                            <img src="{{ asset('storage/' . $color->colorimage) }}"
                                                alt="{{ $color->color }}" class="color-image-thumb color-switcher"
                                                data-img="{{ asset('storage/' . $color->colorimage) }}">
                                        @endif
                                    </div>
                                    <div class="text-center text-muted mt-1 small">{{ $color->color }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif --}}

                <p class="text-muted">{{ $product->description ?? 'No description available.' }}</p>

                @if ($price)
                    <div class="mb-3">
                        @if ($price->discount)
                            <div class="fs-5 text-danger fw-bold">
                                ₹{{ number_format($price->final_price, 2) }}
                                <small class="text-decoration-line-through text-muted ms-2 fs-6">
                                    ₹{{ number_format($price->price, 0) }}
                                </small>
                                <span class="badge bg-danger ms-2">{{ $price->discount }}% OFF</span>
                            </div>
                        @else
                            <div class="h4 text-success fw-bold">
                                ₹{{ number_format($price->price, 2) }}
                            </div>
                        @endif
                    </div>
                @endif
                <div class="mb-4">
                    <button
                        class="btn btn-info text-white rounded-pill py-2 px-4 d-flex justify-content-between align-items-center shadow-sm"
                        type="button" data-bs-toggle="collapse" data-bs-target="#bulkOrderDetail" aria-expanded="false"
                        aria-controls="bulkOrderDetail">
                        <span><i class="bi bi-box-seam-fill me-2"></i> Bulk Order Offers</span>
                        <i class="bi bi-chevron-down ms-2 small"></i>
                    </button>

                    <div class="collapse mt-3" id="bulkOrderDetail">
                        <div class="card card-body border-0 shadow-sm">
                            @foreach ($bulk as $b)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-secondary">
                                        <i class="bi bi-stack me-2"></i> MOQ: {{ $b->bulk_order_quantity }} units
                                    </span>
                                    <span class="text-success">
                                        <i class="bi bi-tags me-2"></i>
                                        ₹{{ number_format($b->price, 2) }} / unit
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- <div class="collapse mt-3" id="bulkOrderDetail">
                        <div class="card card-body border-0 shadow-sm">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0 align-middle text-sm">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="bi bi-stack me-2 text-secondary"></i> MOQ</th>
                                            <td>50 units</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="bi bi-tags me-2 text-success"></i> Bulk Price</th>
                                            <td>₹{{ number_format($price->bulk_price ?? $price->final_price * 0.9, 2) }} /
                                                unit</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="bi bi-clock-history me-2 text-warning"></i> Lead
                                                Time</th>
                                            <td>7–14 business days</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="bi bi-envelope-open me-2 text-danger"></i> Contact
                                            </th>
                                            <td><a href="mailto:sales@example.com">sales@example.com</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <button class="btn btn-outline-secondary mt-4 rounded-pill" onclick="window.history.back()">← Back to
                    Products</button>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if (isset($relatedProducts) && $relatedProducts->count())
        <div class="container mt-5">
            <h3 class="fw-bold mb-4">Related Products</h3>
            <div class="row g-4">
                @foreach ($relatedProducts as $related)
                    <div class="col-md-3 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $related->mimage) }}" class="card-img-top"
                                alt="{{ $related->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $related->name }}</h5>
                                <p class="text-success fw-semibold">
                                    ₹{{ number_format($related->prices->first()->price ?? 0, 2) }}</p>
                                <a href="{{ route('product.show', $related->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- JavaScript -->
    <script>
        function addtocart(productId) {
            $.ajax({
                url: '{{ route('cart.add') }}',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: 1,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    document.getElementById('cartControls').innerHTML = getQuantityControlsHTML(1);
                },
                error: function(xhr) {
                    alert("Error: " + xhr.responseText);
                }
            });
        }

        function updateCartQuantity(productId, quantity) {
            $.ajax({
                url: '{{ route('cart.add') }}',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity,
                    update: true,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("Cart updated:", response.cart);
                },
                error: function(xhr) {
                    alert("Update failed: " + xhr.responseText);
                }
            });
        }

        function removeFromCart(productId) {
            $.ajax({
                url: '{{ route('cart.add') }}',
                type: 'POST',
                data: {
                    product_id: productId,
                    quantity: 0,
                    update: true,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("Product removed from cart");
                },
                error: function(xhr) {
                    alert("Remove failed: " + xhr.responseText);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.side-img');
            const mainImage = document.getElementById('mainProductImage');
            const cartControls = document.getElementById('cartControls');
            const productId = {{ $product->id }};

            thumbnails.forEach(img => {
                img.addEventListener('click', () => mainImage.src = img.src);
            });

            // document.querySelectorAll('.color-switcher').forEach(img => {
            //     img.addEventListener('click', () => {
            //         mainImage.src = img.dataset.img;
            //     });
            // });

            cartControls.addEventListener('click', function(e) {
                const target = e.target.closest('button');

                if (target?.id === 'addToCartBtn') {
                    cartControls.innerHTML = getQuantityControlsHTML(1);
                    updateCartQuantity(productId, 1);
                    return;
                }

                const qtyInput = document.getElementById('quantityCount');
                if (!qtyInput) return;

                let qty = parseInt(qtyInput.value) || 1;

                if (target?.id === 'increaseQty') {
                    qty++;
                    qtyInput.value = qty;
                    updateCartQuantity(productId, qty);
                }

                if (target?.id === 'decreaseQty') {
                    qty--;
                    if (qty <= 0) {
                        cartControls.innerHTML = `
                        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                            <button class="btn btn-success btn-md rounded-pill shadow-sm px-4" id="addToCartBtn">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </div>`;
                        removeFromCart(productId);
                        return;
                    }
                    qtyInput.value = qty;
                    updateCartQuantity(productId, qty);
                }
            });

            // ✅ Debounced input event for manual quantity typing
            let debounceTimer;
            const qtyInput = document.getElementById('quantityCount');
            if (qtyInput) {
                qtyInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        let val = parseInt(this.value);
                        if (isNaN(val) || val <= 0) {
                            cartControls.innerHTML = `
                            <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                <button class="btn btn-success btn-md rounded-pill shadow-sm px-4" id="addToCartBtn">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>`;
                            removeFromCart(productId);
                        } else {
                            updateCartQuantity(productId, val);
                        }
                    }, 500); // Wait 0.5 seconds after typing stops
                });
            }

            function getQuantityControlsHTML(count) {
                setTimeout(() => {
                    const qtyInput = document.getElementById('quantityCount');
                    if (qtyInput) {
                        qtyInput.addEventListener('input', function() {
                            clearTimeout(debounceTimer);
                            debounceTimer = setTimeout(() => {
                                let val = parseInt(this.value);
                                if (isNaN(val) || val <= 0) {
                                    cartControls.innerHTML = `
                            <div class="d-flex flex-column flex-md-row gap-2 justify-content-center">
                                <button class="btn btn-success btn-md rounded-pill shadow-sm px-4" id="addToCartBtn">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>`;
                                    removeFromCart(productId);
                                } else {
                                    updateCartQuantity(productId, val);
                                }
                            }, 500);
                        });
                    }
                }, 10); // delay to wait for DOM insertion

                return `
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
            <button class="btn btn-outline-danger btn-sm rounded-circle fw-bold" id="decreaseQty">−</button>
            <input type="number" id="quantityCount" value="${count}" min="1" class="form-control text-center" style="width: 60px;" />
            <button class="btn btn-outline-success btn-sm rounded-circle fw-bold" id="increaseQty">+</button>
        </div>`;
            }

        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        .main-img {
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .main-img:hover {
            transform: scale(1.03);
        }

        .side-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            border: 2px solid #ddd;
            transition: transform 0.2s ease;
        }

        .side-img:hover {
            transform: scale(1.1);
            border-color: #0d6efd;
        }

        /* .color-option .color-box {
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    overflow: hidden;
                    border: 2px solid #ccc;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    transition: border-color 0.2s;
                }

                .color-option .color-box:hover {
                    border-color: #0d6efd;
                }

                .color-image-thumb {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 50%;
                } */

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
            border: 2px solid #ced4da;
            border-radius: 8px;
            padding: 6px 10px;
            width: 60px;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            transition: border-color 0.2s;
        }

        input[type=number]:focus {
            border-color: #0d6efd;
            outline: none;
        }

        #increaseQty,
        #decreaseQty {
            width: 36px;
            height: 36px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .table td,
        .table th {
            padding: 0.65rem 0.75rem;
            vertical-align: middle;
        }

        .table th {
            width: 150px;
            font-weight: 600;
        }
    </style>
@endsection
