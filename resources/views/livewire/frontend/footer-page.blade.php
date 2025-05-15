{{-- Ye Footer Wala HAi --}}


<div>
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row">
                <!-- Left Column: Copyright -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <p class="m-0">© Your Website 2023. All Rights Reserved.</p>
                </div>

                <!-- Center Column: Social Media Links -->
                <div class="col-lg-3 col-md-6 mb-4 text-center text-md-left">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled d-flex justify-content-center justify-content-md-start">
                        <li class="ms-3"><a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="ms-3"><a href="#" class="text-white"><i class="fab fa-twitter"></i></a></li>
                        <li class="ms-3"><a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li class="ms-3"><a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                    </ul>
                </div>

                <!-- Right Column: Google Map -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <h5>Our Location</h5>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.003330015436!2d-122.43129718468167!3d37.77397297975965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085808e24216f77%3A0x1638c302daed7ad5!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1652661850609!5m2!1sen!2sus"
                            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="border-white">

            <!-- Newsletter Signup -->
            <div class="row">
                <div class="col-md-6">
                    <h5>Sign Up for Our Newsletter</h5>
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Contact Info -->
                <div class="col-md-6">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li>Email: info@yourwebsite.com</li>
                        <li>Phone: +1 (234) 567-890</li>
                        <li>Address: 123 Street, City, Country</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Add Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    {{-- Footer Code Design --}}
    {{-- <footer class="bg-[#e6faff] border-t border-[#cce7f6] text-[#0369a1] text-sm mt-10">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <h2 class="font-bold text-lg mb-3">Plastic</h2>
            <p class="text-sm">High-quality plastic products for everyday needs. Stylish, durable, and affordable.</p>
        </div>
        <div>
            <h2 class="font-semibold mb-3">Quick Links</h2>
            <ul class="space-y-2">
                <li><a href="#" wire:click.prevent="changePage('home')" class="hover:text-[#0ea5e9]">Home</a></li>
                <li><a href="#" wire:click.prevent="changePage('shop')" class="hover:text-[#0ea5e9]">Shop</a></li>
                <li><a href="#" wire:click.prevent="changePage('contact')" class="hover:text-[#0ea5e9]">Contact</a></li>
                <li><a href="#" wire:click.prevent="changePage('sale')" class="hover:text-[#0ea5e9]">Sale</a></li>
            </ul>
        </div>
        <div>
            <h2 class="font-semibold mb-3">Customer Service</h2>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-[#0ea5e9]">Help Center</a></li>
                <li><a href="#" class="hover:text-[#0ea5e9]">Returns</a></li>
                <li><a href="#" class="hover:text-[#0ea5e9]">Shipping</a></li>
                <li><a href="#" class="hover:text-[#0ea5e9]">Privacy Policy</a></li>
            </ul>
        </div>
        <div>
            <h2 class="font-semibold mb-3">Stay Connected</h2>
            <form wire:submit.prevent="subscribeToNewsletter" class="flex flex-col space-y-2">
                <input type="email" wire:model.defer="newsletterEmail" placeholder="Your email"
                    class="px-4 py-2 border border-[#bde0f5] rounded-md focus:outline-none focus:ring-2 focus:ring-[#0ea5e9]">
                <button type="submit"
                    class="bg-[#0ea5e9] text-white py-2 rounded-md hover:bg-[#0284c7] transition">Subscribe</button>
            </form>
        </div>
    </div>
    <div class="text-center py-4 border-t border-[#cce7f6] mt-6 text-xs">
        &copy; {{ date('Y') }} Plastic. All rights reserved.
    </div>
</footer> --}}
</div>
