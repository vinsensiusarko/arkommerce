<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.page-part.css')
</head>

<body>
    @include('sweetalert::alert')

    @include('home.page-part.topbar')

    @include('home.page-part.order.header-order')

    <!-- Main -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Image</th>
                            <th>Cancel Order</th>
                        </tr>
                    </thead>

                    <?php $totalprice = 0; ?>

                    @forelse ($order as $order)
                        <tbody class="align-middle">
                            <tr>
                                <td class="align-middle">{{ $order->product_title }}</td>
                                <td class="align-middle">{{ $order->quantity }}</td>
                                <td class="align-middle">${{ $order->price }}</td>
                                <td class="align-middle">{{ $order->payment_status }}</td>
                                <td class="align-middle">{{ $order->delivery_status }}</td>
                                <td class="align-middle"><img height="120" width="120"
                                        src="product/{{ $order->image }}"></td>
                                <td class="align-middle">
                                    @if ($order->delivery_status == 'Processing')
                                        <a class="btn btn-danger" onclick="confirmation(event)"
                                            href="{{ url('cancel_order', $order->id) }}">Cancel Order</a>
                                    @elseif ($order->delivery_status == 'You canceled the order')
                                        <a class="btn btn-danger disabled" href="#"
                                            aria-disabled="true">Canceled</a>
                                    @else
                                        <a class="btn btn-danger disabled" href="#" aria-disabled="true">Not
                                            Allowed</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16">No Order</td>
                            </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End -->

    @include('home.page-part.footer')

    @include('home.page-part.script')

    <!-- Sweet Alert -->
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to cancel order?",
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
