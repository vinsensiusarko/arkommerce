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

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="row ">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Product</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Title</th>
                                                {{-- <th>Description</th> --}}
                                                <th>Quantity</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Discount Price</th>
                                                <th>Product Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>

                                        @forelse ($product as $product)
                                            <tbody>
                                                <tr>
                                                    <td>{{ $product->title }}</td>
                                                    {{-- <td>{{ $product->description }}</td> --}}
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ $product->category }}</td>
                                                    <td>${{ $product->price }}</td>
                                                    <td>${{ $product->discount_price }}</td>
                                                    <td><img style="width: 120px; height: 120px;" src="/product/{{ $product->image }}"></td>
                                                    <td><a class="btn btn-success"
                                                            href="{{ url('update_product', $product->id) }}">Edit</a>
                                                    </td>
                                                    <td><a class="btn btn-danger"
                                                            onclick="return confirm('Are you sure to delete this')"
                                                            href="{{ url('delete_product', $product->id) }}">Delete</a>
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
