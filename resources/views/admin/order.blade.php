<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSS -->
    @include('admin.css')
    <!-- End CSS -->
</head>

<body>
    <div class="container-scroller">

        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End Sidebar -->

        <!-- Header -->
        @include('admin.header')
        <!-- End Header -->

        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title_dsg">All Orders</h1>

                <form action="{{ url('search') }}" method="GET">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search Order"
                                aria-label="Search Order" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" value="Search" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row ">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Order Status</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Product Title</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Payment Status</th>
                                                <th>Delivery Status</th>
                                                <th>Image</th>
                                                <th>Delivered</th>
                                                <th>Print PDF</th>
                                                <th>Send Email</th>
                                            </tr>
                                        </thead>

                                        @forelse ($order as $order)
                                            <tbody>
                                                <tr>
                                                    <td><span class="pl-2">{{ $order->name }}</span></td>
                                                    <td>{{ $order->email }}</td>
                                                    <td>{{ $order->address }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ $order->product_title }}</td>
                                                    <td>{{ $order->quantity }}</td>
                                                    <td>${{ $order->price }}</td>
                                                    <td>
                                                        @if ($order->payment_status == 'Paid')
                                                            <div class="badge badge-outline-success">Paid</div>
                                                        @else
                                                            <div class="badge badge-outline-warning">Cash on Delivery
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->delivery_status == 'Delivered')
                                                            <div class="badge badge-outline-success">Delivered</div>
                                                        @elseif ($order->delivery_status == 'Processing')
                                                            <div class="badge badge-outline-warning">Processing</div>
                                                        @else
                                                            <div class="badge badge-outline-danger">Canceled</div>
                                                        @endif
                                                    </td>
                                                    <td><img style="width: 80px; height: 80px;"
                                                            src="/product/{{ $order->image }}" alt="Product"></td>
                                                    <td>
                                                        @if ($order->delivery_status == 'Processing')
                                                            <a type="button" href="{{ url('delivered', $order->id) }}"
                                                                class="btn btn-success"
                                                                onclick="return confirm('Are you sure this product is delivered')">Deliver</a>
                                                        @else
                                                            <div class="badge badge-outline-success">Delivered</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a type="button" href="{{ url('print_pdf', $order->id) }}"
                                                            class="btn btn-danger btn-icon-text"> Print PDF <i
                                                                class="mdi mdi-printer btn-icon-append"></i>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ url('send_email', $order->id) }}">Send Email</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="16">No Data Found</td>
                                                </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Panel -->

        <!-- container-scroller -->
        @include('admin.script')
</body>

</html>
