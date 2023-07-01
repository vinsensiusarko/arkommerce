<!DOCTYPE html>
<html>

<head>
    <title>Payment Gateway</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    @include('home.page-part.css')
</head>

<body>

    <!-- Sweet Alert -->
    @include('sweetalert::alert')

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
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
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
            <div class="col-lg-6 col-6 text-left"></div>
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

    <div class="container">
        <h1 style="text-align: center;">Payment Gateway - Total Amount ${{ $totalprice }}</h1>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="float: none; margin: auto; padding-top: 20px;">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h2 class="panel-title" style="text-align: center;">Checkout Forms</h2>
                    </div>
                    <div class="panel-body">

                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif

                        <form id='checkout-form' method='post' action="{{ route('stripe.post', $totalprice) }}">

                            @csrf
                            <input type='hidden' name='stripeToken' id='stripe-token-id'>
                            <br>
                            <div id="card-element" class="form-control"></div>
                            <button id='pay-btn' class="btn btn-success" type="button"
                                style="margin-top: 20px; width: 100%;padding: 7px;" onclick="createToken()">Pay Now $
                                {{ $totalprice }}
                            </button>
                            <form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    /*--Create Token Code--*/

    function createToken() {

        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {

            if (typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */

            if (typeof result.token != 'undefined') {

                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>

</html>
