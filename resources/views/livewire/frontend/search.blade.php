@extends('layouts.main')
@section('content')
    <style>
        /* Scoped CSS for the search section */
        .search-section {
            padding: 60px 20px;
            background: linear-gradient(180deg, #f4f9fb, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .search-title {
            text-align: center;
            color: #0077B6;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .search-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 40px;
        }

        .search-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 119, 182, 0.08);
            transition: 0.3s ease;
        }

        .search-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 180, 216, 0.15);
        }

        .search-card h3 {
            color: #023e8a;
            margin-bottom: 15px;
        }

        .search-card p,
        .search-card a {
            font-size: 1rem;
            color: #333;
        }

        .search-card a {
            text-decoration: none;
            color: #0077B6;
        }

        .search-card a:hover {
            color: #00B4D8;
        }

        .search-form {
            padding: 30px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 119, 182, 0.08);
            transition: 0.3s ease;
        }

        .search-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 180, 216, 0.15);
        }

        .search-form h3 {
            color: #023e8a;
            margin-bottom: 15px;
        }

        .search-form p,
        .search-form a {
            font-size: 1rem;
            color: #333;
        }

        .search-form a {
            text-decoration: none;
            color: #0077B6;
        }

        .search-form a:hover {
            color: #00B4D8;
        }

        .search-form .form-control {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .search-form .form-control:focus {
            border-color: #00B4D8;
            outline: none;
        }

        .search-form .submit-btn {
            background-color: #0077B6;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
        }

        .search-form .submit-btn:hover {
            background-color: #00B4D8;
        }

        .search-form .submit-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .search-form .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .search-form .success-message {
            color: #28a745;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .search-form .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #0077B6;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.75s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .search-form .loading-text {
            font-size: 1rem;
            color: #0077B6;
            margin-left: 10px;
        }

        .search-form .loading-text span {
            font-weight: bold;
        }

        .search-form .loading-text .loading-spinner {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid #0077B6;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.75s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        @media (max-width: 768px) {
            .desktop {
                display: none;
            }
        }
    </style>

    <div class="search-section desktop">
        <div class="container mx-auto">
            {{-- Show products --}}
            @if ($products->isNotEmpty())
                <div class="mt-10">
                    <h2 class="text-2xl font-bold text-center mb-5">Search Results</h2>
                    <!-- For mobile (up to sm screen size) - Hide this section -->
                    <div class="hidden md:block grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $p)
                            <div class="card product-card flex-shrink-0 border-0 shadow-sm" style="width: 250px;">
                                <div class="position-relative overflow-hidden rounded-top">
                                    <img class="card-img-top rounded-top product-img"
                                         src="{{ $p->mimage ? asset('storage/' . $p->mimage) : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg' }}"
                                         alt="{{ $p->name }}">
                                    @if ($p->category)
                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 small">
                                            {{ $p->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <div class="card-body text-center p-3">
                                    <h6 class="fw-bold">{{ $p->name ?? 'Product Name' }}</h6>
                                    @if ($p->category)
                                        <p class="text-muted small mb-1">{{ $p->category->name }}</p>
                                    @endif
                                    @php $price = optional($p->prices->first()); @endphp
                                    @if ($price)
                                        <div class="my-2">
                                            @if ($price->discount)
                                                <span class="text-danger fw-bold">
                                                    {{ number_format($price->discount, 0) }}% OFF
                                                </span><br>
                                                <span class="text-muted text-decoration-line-through small">
                                                    ₹{{ number_format($price->price, 0) }}
                                                </span>
                                            @endif
                                            <div class="text-dark fw-semibold">
                                                ₹{{ number_format($price->final_price ?? 0, 2) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-footer bg-transparent border-0 text-center pb-3">
                                    <a href="/product/{{ $p->id }}"
                                       class="btn btn-sm btn-dark rounded-pill px-3 shadow-sm">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if ($searchTerm)
                    <p class="text-red-500 text-center mt-5">No products found for "{{ $searchTerm }}".</p>
                @endif
            @endif
        </div>
    </div>
@endsection
