    <div>
        <style>
            .sidebar {
                background-color: #f8f9fa;
                padding: 1rem;
                border-radius: 0.5rem;
                max-height: 90vh;
                position: sticky;
                top: 1rem;
                overflow-y: auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            }

            .product-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                border-radius: 0.5rem;
            }

            .product-card:hover {
                transform: scale(1.03);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            .card-title {
                color: #212529;
            }

            .card-text {
                color: #495057;
            }

            .btn-outline-dark {
                transition: all 0.3s ease;
            }

            .btn-outline-dark:hover {
                background-color: #343a40;
                color: #fff;
                border-color: #343a40;
            }

            .heading-custom {
                font-size: 2.5rem;
                font-weight: bold;
                margin-bottom: 2rem;
                color: #343a40;
                text-align: center;
            }

            .card.product-card {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                border-radius: 12px;
            }

            .card.product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            }

            .card-img-top {
                border-top-left-radius: 12px;
                border-top-right-radius: 12px;
            }

            .btn {
                transition: all 0.3s ease;
            }

            .btn:hover {
                transform: scale(1.05);
            }
        </style>
        <div class="container-fluid py-5">
            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-lg-3 mb-4">
                    <div class="sidebar shadow">
                        <h4 class="mb-4">Filter</h4>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Price Range</label>
                                <input type="range" class="form-range" min="0" max="300">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select">
                                    <option>All</option>
                                    <option>Fancy</option>
                                    <option>Sale</option>
                                    <option>Popular</option>
                                    <option>Special</option>
                                </select>
                            </div>
                            <button class="btn btn-dark w-100">Apply Filters</button>
                        </form>
                    </div>
                </div>

                <!-- Product Section -->
                <div class="col-lg-9">
                    <h2 class="heading-custom mb-4 text-primary fw-bold">Our Products</h2>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                        @foreach ($products as $p)
                            <div class="col">
                                <div class="card h-100 product-card shadow-sm border-0">
                                    <div
                                        style="height: 150px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 0.25rem;">
                                        <img src="{{ $p->mimage ? asset('storage/' . $p->mimage) : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}"
                                            alt="{{ $p->name }}"
                                            style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title fw-semibold text-dark mb-2">
                                            {{ $p->name ?? 'Fancy Product' }}</h5>

                                        @php
                                            $price = optional($p->prices->first());
                                        @endphp

                                        @if ($price && ($price->discount || $price->price))
                                            <div class="mb-2">
                                                @if ($price->discount)
                                                    <span
                                                        class="text-danger fw-bold h5">{{ number_format($price->discount, 0) }}%</span>
                                                    <!-- Format discount -->
                                                    <span
                                                        class="text-muted text-decoration-line-through ms-2">₹{{ number_format($price->price, 0) }}</span>
                                                    <!-- Format price -->
                                                @else
                                                    <span
                                                        class="text-dark fw-bold h5">₹{{ number_format($price->price, 0) }}</span>
                                                    <!-- Format price -->
                                                @endif
                                            </div>
                                        @else
                                            <div class="mb-2">
                                                <span class="text-dark fw-bold h5">₹40 - ₹80</span>
                                                <!-- Format range without decimals -->
                                            </div>
                                        @endif

                                        <p class="card-text text-muted small">
                                            Price:
                                            <strong>₹{{ number_format($price->final_price ?? 0, 2) }}</strong>
                                        </p>
                                    </div>

                                    <div class="card-footer bg-transparent border-0 text-center">
                                        <a href="/product/{{ $p->id }}"
                                            class="btn btn-dark btn-sm w-75 rounded-pill shadow-sm">
                                            View Options
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </div>
