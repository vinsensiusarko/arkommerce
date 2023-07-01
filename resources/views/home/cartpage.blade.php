<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.page-part.css')
</head>

<body>
    @include('sweetalert::alert')

    @include('home.page-part.topbar')

    @include('home.page-part.cart.header-cart')

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                    <?php $totalprice = 0; ?>

                    @forelse ($cart as $cart)
                        <tbody class="align-middle">
                            <tr>
                                <td class="align-middle"><img src="/product/{{ $cart->image }}" alt=""
                                        style="width: 50px;">
                                    {{ $cart->product_title }}</td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary text-center"
                                            name="quantity" value="{{ $cart->quantity }}" min="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <?php $totalprice = $totalprice + $cart->price; ?>
                                <td class="align-middle">${{ $totalprice }}</td>
                                <td class="align-middle"><a href="{{ url('remove_cart', $cart->id) }}"
                                        onclick="confirmation(event)" class="btn btn-sm btn-primary"><i
                                            class="fa fa-times"></i></a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16">Cart Empty</td>
                            </tr>
                        </tbody>
                    @endforelse
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">${{ $totalprice }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$2</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">${{ $totalprice }}</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="col-lg-6">
                                <a class="btn btn-block btn-primary my-3 py-3" href="{{ url('cash_order') }}">Cash On
                                    Delivery</a>
                            </div>
                            <div class="col-lg-6">
                                <a class="btn btn-block btn-primary my-3 py-3"
                                    href="{{ url('stripe', $totalprice) }}">Pay With Card</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    @include('home.page-part.footer')

    @include('home.page-part.script')

    <!-- Sweet Alert -->
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to cancel this product",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {

                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>

</body>

</html>
