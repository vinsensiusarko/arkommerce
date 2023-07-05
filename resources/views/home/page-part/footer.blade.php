    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border border-white px-3 mr-1">A</span>rkommerce</h1>
                </a>
                {{-- <p class="mb-2">Arkommerce adalah sebuah aplikasi fullstack web e-commerce dibuat menggunakan Framework Laravel,
                    Passion, Ketekunan dan ❤️</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Jl. Kelud Selatan No. 12</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>vinsensiusarka@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p> --}}
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{ url('/') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="{{ url('products') }}"><i class="fa fa-angle-right mr-2"></i>Product</a>
                            <a class="text-dark mb-2" href="{{ url('show_order') }}"><i class="fa fa-angle-right mr-2"></i>Order</a>
                            <a class="text-dark mb-2" href="{{ url('show_cart') }}"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="{{ url('about_us') }}"><i
                                    class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-dark" href="{{ url('contact') }}"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{ url('/') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-dark mb-2" href="{{ url('products') }}"><i class="fa fa-angle-right mr-2"></i>Product</a>
                            <a class="text-dark mb-2" href="{{ url('show_order') }}"><i class="fa fa-angle-right mr-2"></i>Order</a>
                            <a class="text-dark mb-2" href="{{ url('show_cart') }}"><i class="fa fa-angle-right mr-2"></i>Shopping
                                Cart</a>
                            <a class="text-dark mb-2" href="{{ url('about_us') }}"><i
                                    class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-dark" href="{{ url('contact') }}"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name"
                                    required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe
                                    Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                {{-- <p class="mb-md-0 text-center text-md-left text-dark">
                    <a class="text-dark font-weight-semi-bold" href="{{ url('/') }}">Arkommerce</a>.
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Make With ❤️ By <a href="https://vinsensiusarko.web.app/"
                        target="_blank">Vinsensius Arka</a><br>
                    Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </p> --}}
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="/home/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
