@extends('layouts.main')
@section('content')
    <style>
        .about-wrapper {
            padding: 60px 20px;
            background: linear-gradient(180deg, #f0faff, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .brand-title {
            color: #0077B6;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .subheading {
            font-size: 1.2rem;
            color: #555;
        }

        .highlight-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 24px rgba(0, 119, 182, 0.08);
            border-left: 5px solid #00b4d8;
            transition: all 0.3s ease;
        }

        .highlight-box:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 28px rgba(0, 180, 216, 0.15);
        }

        .highlight-box h3 {
            color: #023e8a;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .highlight-box p {
            color: #333;
            line-height: 1.7;
        }

        .certification-img {
            width: 100%;
            max-height: 240px;
            border-radius: 12px;
            border: 2px solid #90e0ef;
            object-fit: cover;
        }

        .contact-card {
            text-align: center;
            background: #f0f9ff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 183, 255, 0.06);
            margin-top: 40px;
        }

        .contact-card a {
            color: #0077B6;
            text-decoration: none;
        }

        .contact-card a:hover {
            color: #00b4d8;
        }

        @media (max-width: 768px) {
            .brand-title {
                font-size: 2rem;
            }

            .highlight-box {
                padding: 20px;
            }
        }
    </style>

    <div class="about-wrapper">
        <div class="text-center mb-5">
           
            <h1 class="brand-title">Rathi Bandhu</h1>
            <p class="subheading">Trusted Manufacturer of Quality Plastic Products</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="highlight-box">
                    <h3><i class="fas fa-history icon"></i> Our Journey</h3>
                    <p>Started with a vision to redefine plastic manufacturing, Rathi Bandhu has grown into a name synonymous with durability, hygiene, and innovation. Our legacy is built on trust and continual improvement.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="highlight-box">
                    <h3><i class="fas fa-bullseye icon"></i> Mission & Vision</h3>
                    <p>Our mission is to deliver top-tier plastic products that are safe, sustainable, and affordable. We envision a cleaner, smarter future with responsible plastic use in every home and business.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="highlight-box">
                    <h3><i class="fas fa-box icon"></i> Our Products</h3>
                    <p>From food-grade containers to custom industrial plastics, our diverse range is crafted with quality and compliance in mind. All products are rigorously tested and customer-approved.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="highlight-box">
                    <h3><i class="fas fa-users icon"></i> Our Customers</h3>
                    <p>We proudly serve industries, wholesalers, and retail businesses across India. Our long-term clients trust us for timely delivery, product integrity, and transparent dealings.</p>
                </div>
            </div>
        </div>

        <div class="text-center my-5">
            <h2 class="brand-title"><i class="fas fa-star icon"></i> Achievements & Uniqueness</h2>
            <p class="subheading">What sets us apart is our unwavering commitment to hygiene, quality assurance, and customer satisfaction. We are certified and recognized for our excellence.</p>
        </div>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="highlight-box">
                    <h4>FSSAI Certified</h4>
                    <img src="https://img.freepik.com/premium-vector/certificate-template-design-a4-size_35986-453.jpg"
                         alt="FSSAI Certificate" class="certification-img mt-2">
                    <p class="mt-2"><strong>No:</strong> 12224017000443</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="highlight-box">
                    <h4>GST Registered</h4>
                    <img src="https://img.freepik.com/premium-vector/certificate-template-design-a4-size_35986-453.jpg"
                         alt="GST Certificate" class="certification-img mt-2">
                    <p class="mt-2"><strong>GSTIN:</strong> 08AOZPP3505Q1ZX</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="highlight-box">
                    <h4>MSME Certified</h4>
                    <img src="https://img.freepik.com/premium-vector/certificate-template-design-a4-size_35986-453.jpg"
                         alt="MSME Certificate" class="certification-img mt-2">
                    <p class="mt-2"><strong>MSME No:</strong> [Your MSME Number]</p>
                </div>
            </div>
        </div>

        <div class="contact-card">
            <h2 class="brand-title"><i class="fas fa-address-book icon"></i> Contact Us</h2>
            <p>
                <strong>Address:</strong><br>
                Road Number 7, Industrial Area,<br>
                Rani Bazar, Bikaner - 334001, Rajasthan, India<br><br>

                <strong>Phone:</strong><br>
                <a href="tel:+918239070019">+91 8239070019</a> / 
                <a href="tel:+919887501872">+91 9887501872</a><br><br>

                <strong>Email:</strong><br>
                <a href="mailto:gisoanpapdi@gmail.com">gisoanpapdi@gmail.com</a><br><br>

                <strong>Follow Us:</strong><br>
                <a href="#"><i class="fab fa-facebook icon"></i> Facebook</a> | 
                <a href="#"><i class="fab fa-instagram icon"></i> Instagram</a>
            </p>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
