{{-- YE Front Design HAi User KA --}}
<div>
    <!-- Bootstrap 5 CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
        .hero-img {
            height: 90vh;
            object-fit: cover;
            width: 100%;
        }

        .hero-section h1,
        .hero-section p {
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
        }

        .hero-section .btn-warning {
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s ease-in-out;
        }

        .hero-section .btn-warning:hover {
            background-color: #d39e00;
            transform: scale(1.05);
        }

        .hero-section .btn-info {
            border-radius: 30px;
            font-weight: bold;
            transition: 0.3s ease-in-out;
        }

        .hero-section .btn-info:hover {
            background-color: #0dcaf0;
            transform: scale(1.05);
        }

        .product-card img {
            transition: transform 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            max-width: 100%;
        }

        .product-card img:hover {
            transform: scale(1.05);
        }

        .offer-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
        }

        .btn-rounded {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-rounded:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.2);
        }

        /* Remove background and shadow from carousel item */
        .carousel-item {
            background: transparent !important;
            box-shadow: none !important;
        }

        .carousel {
            background-color: transparent !important;
            /* Ensures no background color */
            padding: 0 !important;
            /* Removes any unwanted padding */
        }

        /* Responsive control - keep items in row even on mobile */
        .carousel-inner .d-flex {
            flex-wrap: nowrap !important;
            gap: 20px;
        }

        @media (max-width: 768px) {

            .product-card,
            .offer-box {
                min-width: 150px !important;
                /* smaller min width */
                max-width: 200px !important;
                /* smaller max width */
                padding: 15px !important;
                /* smaller padding for offer box */
            }

            .offer-box {
                padding: 15px !important;
            }
        }

        /* .carousel-control-prev,
        .carousel-control-next {
            display: none !important;
            /* Hides the previous/next arrows */
        /* } */

        .carousel-item img {
            object-fit: cover;
            width: 100%;
            /* Ensure the image spans the full width */
            height: 100vh;
            /* Makes the image height equal to the full viewport height */
        }

        .scroll-container {
            scroll-behavior: smooth;
            white-space: nowrap;
            padding-bottom: 1rem;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            opacity: 0.8;
        }

        .left-btn {
            left: -10px;
        }

        .right-btn {
            right: -10px;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .scroll-container {
            scroll-behavior: smooth;
            white-space: nowrap;
            padding-bottom: 1rem;
            scrollbar-width: none;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            width: 40px;
            height: 40px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .left-btn {
            left: -15px;
        }

        .right-btn {
            right: -15px;
        }

        .product-card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: none !important;
            /* Prevents any transformation (zoom, scale, etc.) on hover */
            box-shadow: none !important;
            /* Removes any box-shadow effect on hover */
        }

        .product-img {
            height: 150px;
            width: 100%;
            object-fit: contain;
            /* background-color: #f8f9fa; */
            background-color: transparent;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .category-heading {
            font-size: 2.5rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
            /* important for centering */
            padding-bottom: 10px;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out;
        }

        .category-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background-color: #0d6efd;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .category-heading:hover::after {
            width: 90%;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            text-align: center;
            padding: 10px;
            /* Reduced padding */
        }

        .product-card img {
            width: 100%;
            /* Makes the image span the full width */
            height: auto;
            /* Adjusts the height proportionally */
        }

        .product-card img:hover {
            transform: none !important;
            /* Prevents image zoom or scaling on hover */
        }

        /* Adjust the offer box size */
        .offer-box {
            background: #ffffff;
            padding: 15px;
            /* Reduced padding */
            border-radius: 12px;
            /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .offer-box h1 {
            font-size: 1.4rem;
            /* Reduced font size */
        }

        .offer-box p {
            font-size: 1rem;
            /* Reduced font size */
        }

        .btn-rounded {
            font-size: 0.9rem;
            /* Smaller button text */
            padding: 8px 20px;
            /* Reduced padding */
        }

        /* Add padding and margin for responsiveness on mobile */
        @media (max-width: 768px) {
            .swiper-slide {
                max-width: 250px;
                /* Even smaller on mobile */
            }

            .product-card img {
                max-width: 90%;
                /* Make images a bit smaller */
            }

            .offer-box {
                padding: 10px;
                /* Even smaller padding on mobile */
            }

            .btn-rounded {
                padding: 6px 18px;
                /* Adjust button padding */
            }
        }

        @media (max-width: 768px) {
            #mobileCarousel .carousel-item {
                height: 220px !important;

            }

            #mobileCarousel .carousel-item img.mobile-carousel-img {
                height: 220px !important;

                object-fit: cover;
                width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .scroll-btn {
                display: none !important;
            }
        }
    </style>


    {{-- <style>
        .product-card img {
            transition: transform 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            max-width: 100%;
        }

        /*
        .product-card img:hover {
            transform: scale(1.05);
        } */

        .offer-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
        }

        .btn-rounded {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-rounded:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.2);
        }

        /* Remove background and shadow from carousel item */
        .carousel-item {
            background: transparent !important;
            box-shadow: none !important;
        }

        .carousel {
            background-color: transparent !important;
            /* Ensures no background color */
            padding: 0 !important;
            /* Removes any unwanted padding */
        }

        /* Responsive control - keep items in row even on mobile */
        .carousel-inner .d-flex {
            flex-wrap: nowrap !important;
            gap: 20px;
        }

        @media (max-width: 768px) {

            .product-card,
            .offer-box {
                min-width: 150px !important;
                /* smaller min width */
                max-width: 200px !important;
                /* smaller max width */
                padding: 15px !important;
                /* smaller padding for offer box */
            }

            .offer-box {
                padding: 15px !important;
            }
        }

        /* .carousel-control-prev,
        .carousel-control-next {
            display: none !important;
            /* Hides the previous/next arrows */
        /* } */

        .carousel-item img {
            object-fit: cover;
            width: 100%;
            /* Ensure the image spans the full width */
            height: 100vh;
            /* Makes the image height equal to the full viewport height */
        }

        .scroll-container {
            scroll-behavior: smooth;
            white-space: nowrap;
            padding-bottom: 1rem;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            opacity: 0.8;
        }

        .left-btn {
            left: -10px;
        }

        .right-btn {
            right: -10px;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .scroll-container {
            scroll-behavior: smooth;
            white-space: nowrap;
            padding-bottom: 1rem;
            scrollbar-width: none;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            width: 40px;
            height: 40px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .left-btn {
            left: -15px;
        }

        .right-btn {
            right: -15px;
        }

        .product-card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: none !important;
            /* Prevents any transformation (zoom, scale, etc.) on hover */
            box-shadow: none !important;
            /* Removes any box-shadow effect on hover */
        }

        .product-img {
            height: 150px;
            width: 100%;
            object-fit: contain;
            /* background-color: #f8f9fa; */
            background-color: transparent;
        }

        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .category-heading {
            font-size: 2.5rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
            /* important for centering */
            padding-bottom: 10px;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out;
        }

        .category-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background-color: #0d6efd;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .category-heading:hover::after {
            width: 90%;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 768px) {
            .mobile-slider {
                display: none;
            }
        }

        .mobile-slider {
            width: 100%;
            height: auto;
            /* Let it adjust with content */
            padding: 10px 0;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            background: transparent;
            flex-direction: column;
            width: 100%;
            max-width: 280px;
            /* Adjust max-width for smaller size */
            margin: auto;
        }

        /* Ensure the product cards and offer boxes are horizontally aligned */
        .swiper-slide .product-card,
        .swiper-slide .offer-box {
            width: 100%;
            max-width: 280px;
            /* Make sure the content fits properly */
            padding: 15px;
            margin: auto;
        }

        /* Style for the product cards inside each slide */
        .product-card {
            text-align: center;
            padding: 10px;
            /* Reduced padding */
        }

        .product-card img {
            width: 100%;
            /* Makes the image span the full width */
            height: auto;
            /* Adjusts the height proportionally */
        }

        .product-card img:hover {
            transform: none !important;
            /* Prevents image zoom or scaling on hover */
        }

        /* Adjust the offer box size */
        .offer-box {
            background: #ffffff;
            padding: 15px;
            /* Reduced padding */
            border-radius: 12px;
            /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .offer-box h1 {
            font-size: 1.4rem;
            /* Reduced font size */
        }

        .offer-box p {
            font-size: 1rem;
            /* Reduced font size */
        }

        .btn-rounded {
            font-size: 0.9rem;
            /* Smaller button text */
            padding: 8px 20px;
            /* Reduced padding */
        }

        /* Add padding and margin for responsiveness on mobile */
        @media (max-width: 768px) {
            .swiper-slide {
                max-width: 250px;
                /* Even smaller on mobile */
            }

            .product-card img {
                max-width: 90%;
                /* Make images a bit smaller */
            }

            .offer-box {
                padding: 10px;
                /* Even smaller padding on mobile */
            }

            .btn-rounded {
                padding: 6px 18px;
                /* Adjust button padding */
            }
        }

        @media (max-width: 768px) {
            #mobileCarousel .carousel-item {
                height: 220px !important;
                /* Force the whole slide to this height */
            }

            #mobileCarousel .carousel-item img.mobile-carousel-img {
                height: 220px !important;
                /* Override any Bootstrap or inline height */
                object-fit: cover;
                width: 100% !important;
            }
        }
    </style> --}}

    {{-- Desktop Only --}}
    <section class="hero-section d-none d-md-block">
        <div class="container-fluid px-0">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000"
                data-bs-touch="true">
                <div class="carousel-inner">
                    @foreach ($sliders as $index => $slide)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="hero-slide
                                position-relative">
                                <img src="{{ Storage::url($slide->image) }}" class="hero-img w-100"
                                    alt="Slide {{ $index + 1 }}" style="height: 90vh; object-fit: cover;">
                                <div
                                    class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
                                    {{-- Optional: Add caption or overlay text here --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Carousel Indicators --}}
                <div class="carousel-indicators mb-3">
                    @foreach ($sliders as $index => $slide)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"
                            aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    

    {{-- Mobile HAi --}}
    <section class="hero-section d-block d-md-none">
        <div class="container-fluid px-0">
            <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000"
                data-bs-touch="true">
                <div class="carousel-inner">
                    @foreach ($sliders as $index => $slide)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="hero-slide position-relative">
                                <img src="{{ Storage::url($slide->mobile_image) }}" class="hero-img w-100"
                                    alt="Slide {{ $index + 1 }}" style="height: 90vh; object-fit: cover;">
                                <div
                                    class="position-absolute top-50 start-50 translate-middle text-center text-white px-3">
                                    {{-- Optional: Add caption or overlay text here --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Carousel Indicators --}}
                <div class="carousel-indicators mb-3">
                    @foreach ($sliders as $index => $slide)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"
                            aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>




    <!-- Carousel Section -->
    <!-- Desktop-only carousel -->
    {{-- <div id="productCarousel" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Loop through the sliders dynamically -->
            @foreach ($sliders as $index => $slide)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($slide->image) }}" class="d-block w-100 img-fluid"
                        alt="Slide {{ $index + 1 }}">
                    <div class="carousel-caption text-shadow">
                        <a href="#shop-now" class="btn btn-primary btn-lg rounded-pill shadow-lg">Shop Now</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Desktop-only Prev Arrow -->
        <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#productCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <!-- Desktop-only Next Arrow -->
        <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#productCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Mobile Slider --}}
    {{-- <div id="mobileCarousel" class="carousel slide d-block d-md-none" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Loop through the sliders dynamically for mobile -->
            @foreach ($sliders as $index => $slide)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($slide->image) }}" class="d-block w-100 mobile-carousel-img"
                        alt="Slide {{ $index + 1 }}">
                    <div class="carousel-caption text-shadow">
                        <a href="#shop-now" class="btn btn-primary btn-lg rounded-pill shadow-lg">Shop Now</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}

    {{-- <style>
        .product-card img {
            transition: transform 0.3s ease;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            max-width: 100%;
        }

        .product-card img:hover {
            transform: scale(1.05);
        }

        .offer-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
        }

        .btn-rounded {
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-rounded:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.2);
        }

        /* Remove background and shadow from carousel item */
        .carousel-item {
            background: transparent !important;
            box-shadow: none !important;
        }

        /* Responsive control - keep items in row even on mobile */
        .carousel-inner .d-flex {
            flex-wrap: nowrap !important;
            gap: 20px;
        }

        @media (max-width: 768px) {

            .product-card,
            .offer-box {
                min-width: 150px !important;
                /* smaller min width */
                max-width: 200px !important;
                /* smaller max width */
                padding: 15px !important;
                /* smaller padding for offer box */
            }

            .offer-box {
                padding: 15px !important;
            }
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #000;
            border-radius: 50%;
            padding: 10px;
        }

        .scroll-container {
            scroll-behavior: smooth;
            white-space: nowrap;
            padding-bottom: 1rem;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            opacity: 0.8;
        }

        .left-btn {
            left: -10px;
        }

        .right-btn {
            right: -10px;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .scroll-container {
            scroll-behavior: smooth;
            white-space: nowrap;
            padding-bottom: 1rem;
            scrollbar-width: none;
        }

        .scroll-container::-webkit-scrollbar {
            display: none;
        }

        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            width: 40px;
            height: 40px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .left-btn {
            left: -15px;
        }

        .right-btn {
            right: -15px;
        }

        .product-card {
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 150px;
            width: 100%;
            object-fit: contain;
            /* background-color: #f8f9fa; */
            background-color: transparent;
        }


        .product-card:hover .product-img {
            transform: scale(1.05);
        }

        .category-heading {
            font-size: 2.5rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #0d6efd, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
            /* important for centering */
            padding-bottom: 10px;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out;
        }

        .category-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background-color: #0d6efd;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .category-heading:hover::after {
            width: 90%;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 768px) {
            .mobile-slider {
                display: none;
            }
        }

        /* Basic styles for mobile slider */
        .mobile-slider {
            width: 100%;
            height: 200px;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee;
            font-size: 20px;
        }
    </style>

    <!-- Carousel Section -->
    <!-- Desktop-only carousel -->
    <div id="productCarousel" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
        <div class="carousel-inner">

            <!-- Slide 1 -->
            <div class="carousel-item active">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-center text-center gap-4">

                        <!-- Left Image -->
                        <div class="product-card" style="min-width: 300px; max-width: 400px;">
                            <img src="https://img.freepik.com/premium-photo/beautiful-asian-woman-carrying-colorful-bags-shopping-online-with-mobile-phone_8087-3877.jpg?semt=ais_hybrid&w=740"
                                class="img-fluid mb-2" alt="Bloom Casserole">
                            <h5>Bloom Casserole</h5>
                        </div>

                        <!-- Offer Box Center -->
                        <div class="offer-box">
                            <h1 class="display-6 fw-bold text-primary">GET 10% OFF</h1>
                            <p class="mb-1 fs-5">ON YOUR FIRST PURCHASE</p>
                            <p class="fw-bold fs-6">CODE: <span class="text-dark">WELCOME10</span></p>
                            <a href="#" class="btn btn-primary btn-rounded">Shop Now</a>
                        </div>

                        <!-- Right Image -->
                        <div class="product-card" style="min-width: 300px; max-width: 400px;">
                            <img src="https://img.freepik.com/premium-photo/beautiful-asian-woman-carrying-colorful-bags-shopping-online-with-mobile-phone_8087-3877.jpg?semt=ais_hybrid&w=740"
                                class="img-fluid mb-2" alt="Bethany Casserole">
                            <h5>Bethany Casserole</h5>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Controls -->
        <div class="carousel-custom-controls">
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    {{-- Mobile Slider --}}
    <!-- Slider container -->
    {{-- <div class="mobile-slider swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">Slide 1</div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
        </div>
        <!-- Pagination (optional) -->
        <div class="swiper-pagination"></div>
    </div> --}}



    <!-- Bootstrap 5 JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <header>
        <div id="sliderCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $index => $slide)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($slide->image) }}" class="d-block w-100 img-fluid"
                            alt="Slide {{ $index + 1 }}">
                        <div class="carousel-caption text-shadow">
                            <a href="#shop-now" class="btn btn-primary btn-lg rounded-pill shadow-lg">Shop Now</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#sliderCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#sliderCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </header> --}}

    {{-- Section Start --}}
    <section>
        <div class="container px-4 px-lg-5 mt-5">
            @foreach ($categories as $category)
                @if ($category->products->isNotEmpty())
                    <div class="text-center">
                        <h3 class="category-heading" id="category-{{ $category->id }}">
                            {{-- <i class="bi bi-star-fill me-2"></i> --}}
                            {{ $category->name }}
                        </h3>
                    </div>

                    <div class="position-relative mb-5">
                        <!-- Scroll Arrows -->
                        <button class="scroll-btn left-btn btn btn-light shadow-sm rounded-circle"
                            data-target="scroll-{{ $category->id }}">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div id="scroll-{{ $category->id }}" class="scroll-container d-flex overflow-auto px-3 gap-4">
                            @foreach ($category->products as $p)
                                <div class="card product-card flex-shrink-0 border-0 shadow-sm" style="width: 250px;">
                                    <div class="position-relative overflow-hidden rounded-top">
                                        <img class="card-img-top rounded-top product-img"
                                            src="{{ $p->mimage ? asset('storage/' . $p->mimage) : 'https://dummyimage.com/400x400/dee2e6/6c757d.jpg' }}"
                                            alt="{{ $p->name }}">
                                        <span class="badge bg-primary position-absolute top-0 start-0 m-2 small">
                                            {{ $category->name }}
                                        </span>
                                    </div>

                                    <div class="card-body text-center p-3">
                                        <h6 class="fw-bold">{{ $p->name ?? 'Plastic Product' }}</h6>
                                        @php $price = optional($p->prices->first()); @endphp
                                        @if ($price)
                                            <div class="my-2">
                                                @if ($price->discount)
                                                    <span class="text-danger fw-bold">
                                                        {{ number_format($price->discount, 0) }}% OFF
                                                    </span><br>
                                                    @endif
                                                    <div class="text-success fw-semibold">
                                                        ₹{{ number_format($price->final_price ?? 0, 2) }}
                                                    </div>
                                                    <span class="text-muted text-decoration-line-through small">
                                                        ₹{{ number_format($price->price, 0) }}
                                                    </span>
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

                        <button class="scroll-btn right-btn btn btn-light shadow-sm rounded-circle"
                            data-target="scroll-{{ $category->id }}">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        document.querySelectorAll('.scroll-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const container = document.getElementById(btn.dataset.target);
                const scrollAmount = 270; // Adjust as needed (width of one card)

                if (btn.classList.contains('left-btn')) {
                    container.scrollBy({
                        left: -scrollAmount,
                        behavior: 'smooth'
                    });
                } else {
                    container.scrollBy({
                        left: scrollAmount,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</div>
