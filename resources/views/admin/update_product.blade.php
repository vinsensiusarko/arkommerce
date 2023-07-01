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

                <div class="col-md-8 grid-margin stretch-card" style="float: none; margin: auto; padding-top: 20px;">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Product</h4>
                            <p class="card-description"> Edit Product data Arkommerce </p>
                            <form class="forms-sample" action="{{ url('/update_product_confirm', $product->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Product Title :</label>
                                    <input type="text" class="form-control" name="title"
                                        placeholder="Write a title" required="" value="{{ $product->title }}">
                                </div>
                                <div class="form-group">
                                    <label>Product Description :</label>
                                    <input type="text" class="form-control" name="description"
                                        placeholder="Write a description" required=""
                                        value="{{ $product->description }}">
                                </div>
                                <div class="form-group">
                                    <label>Product Price :</label>
                                    <input type="number" class="form-control" name="price"
                                        placeholder="Write a Discount if apply" value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label>Discount Price :</label>
                                    <input type="number" class="form-control" name="disc_price"
                                        placeholder="Write a Discount if apply" value="{{ $product->discount_price }}">
                                </div>
                                <div class="form-group">
                                    <label>Product Quantity :</label>
                                    <input type="number" class="form-control" min="0" name="quantity"
                                        placeholder="Write a quantity" required="" value="{{ $product->quantity }}">
                                </div>
                                <div class="form-group">
                                    <label>Product Category :</label>
                                    <select class="form-control" name="category" required="">
                                        <option value="{{ $product->category }}" selected="">{{ $product->category }}
                                        </option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->category_name }}">
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="product_design">
                                    <label>Current Product Image :</label>
                                    <img height="100" width="100" src="/product/{{ $product->image }}"
                                        style="margin:auto;">
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
                                <button type="submit" class="btn btn-primary mr-2">Update Product</button>
                                <button class="btn btn-dark" type="reset">Reset</button>
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
