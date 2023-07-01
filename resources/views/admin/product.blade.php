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

                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Product</h4>
                            <p class="card-description"> Add Product To Arkommerce System </p>
                            <form class="forms-sample" action="{{ url('/add_product') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Product Title</label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Product Title" required="">
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <input type="text" class="form-control" name="description"
                                        placeholder="Description" required="">
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="Price"
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label>Discount Price</label>
                                    <input type="number" class="form-control" name="disc_price" placeholder="Discount">
                                </div>
                                <div class="form-group">
                                    <label>Product Quantity</label>
                                    <input type="number" class="form-control" name="quantity" placeholder="Quantity"
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select class="form-control" name="category" required="">
                                        <option value="" selected="">Add Category</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->category_name }}">
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="image" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Add Product</button>
                                <button class="btn btn-dark" type="reset">Clear Form</button>
                            </form>
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
