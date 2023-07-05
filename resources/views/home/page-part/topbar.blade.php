    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="#" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="#" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="#"
                        target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="#" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="#">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{ url('/') }}" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">A</span>rkommerce</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="{{ url('search_product') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search for products">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <?php
                if (Auth::user()) {
                    $order_amount = DB::table('orders')
                        ->where('user_id', Auth::user()->id)
                        ->where('delivery_status','Processing')
                        ->count();
                } else {
                    $order_amount = 0;
                }
                ?>
                <a href="{{ url('show_order') }}" class="btn border">
                    <i class="fas fa-clipboard-list text-primary"></i>
                    <span class="badge">{{ $order_amount }}</span>
                </a>
                <?php
                if (Auth::user()) {
                    $cart_amount = DB::table('carts')
                        ->where('user_id', Auth::user()->id)
                        ->count();
                } else {
                    $cart_amount = 0;
                }
                ?>
                <a href="{{ url('show_cart') }}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">{{ $cart_amount }}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
