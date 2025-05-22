@extends('layouts.main')
@section('content')
    <style>
        /* Scoped CSS for the contact section */
        .contact-section {
            padding: 60px 20px;
            background: linear-gradient(180deg, #f4f9fb, #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }

        .contact-title {
            text-align: center;
            color: #0077B6;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .contact-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 40px;
        }

        .contact-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 119, 182, 0.08);
            transition: 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 180, 216, 0.15);
        }

        .contact-card h3 {
            color: #023e8a;
            margin-bottom: 15px;
        }

        .contact-card p,
        .contact-card a {
            font-size: 1rem;
            color: #333;
        }

        .contact-card a {
            text-decoration: none;
            color: #0077B6;
        }

        .contact-card a:hover {
            color: #00B4D8;
        }

        .contact-form {
            padding: 30px;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 183, 255, 0.06);
        }

        .contact-section .form-control {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        .contact-section .form-control:focus {
            border-color: #00B4D8;
            outline: none;
        }

        .submit-btn {
            background-color: #0077B6;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #00B4D8;
        }

        /* Media Query for smaller screens */
        @media (max-width: 768px) {
            .contact-title {
                font-size: 2rem;
            }

            .contact-card,
            .contact-form {
                padding: 20px;
            }
        }
        
        /* Additional styles for navbar search to avoid conflict */
        .navbar-search .form-control {
            /* Specific styles for the navbar search form */
            border-radius: 20px;
            padding: 8px 12px;
            border-color: #ccc;
        }

        /* Adjust navbar button styles if necessary */
        .navbar .navbar-btn {
            background-color: #0077B6;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .navbar .navbar-btn:hover {
            background-color: #00B4D8;
        }
    </style>

    <div class="contact-section container">
        <h2 class="contact-title">Get in Touch</h2>
        <p class="contact-subtitle">We’re here to answer your questions and help you connect with us directly.</p>

        <div class="row">
            <!-- Contact Info Card -->
            <div class="col-md-6 mb-4">
                <div class="contact-card">
                    <h3><i class="fas fa-map-marker-alt icon"></i> Our Address</h3>
                    <p>Road Number 7, Industrial Area, Rani Bazar, Bikaner - 334001, Rajasthan, India</p>

                    <h3><i class="fas fa-phone icon"></i> Phone</h3>
                    <p><a href="tel:+918239070019">+91 82390 70019</a><br><a href="tel:+919887501872">+91 98875 01872</a></p>

                    <h3><i class="fas fa-envelope icon"></i> Email</h3>
                    <p><a href="mailto:gisoanpapdi@gmail.com">gisoanpapdi@gmail.com</a></p>

                    <h3><i class="fas fa-globe icon"></i> Social Media</h3>
                    <p>
                        <a href="#"><i class="fab fa-facebook"></i> Facebook</a> |
                        <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6 mb-4">
                <div class="contact-form">
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Your Name" class="form-control" required>
                        <input type="email" name="email" placeholder="Your Email" class="form-control" required>
                        <input type="text" name="subject" placeholder="Subject" class="form-control">
                        <textarea name="message" placeholder="Your Message" rows="5" class="form-control" required></textarea>
                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
