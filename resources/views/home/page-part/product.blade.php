<!-- Sweet Alert -->
@include('sweetalert::alert')

<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">

        @foreach ($product as $products)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="product/{{ $products->image }}" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $products->title }}</h6>

                        @if ($products->discount_price != null)
                            <div class="d-flex justify-content-center">
                                <h6>${{ $products->discount_price }}</h6>
                                <h6 class="text-muted ml-2"><del>${{ $products->price }}</del></h6>
                            </div>
                        @else
                            <h6>${{ $products->price }}</h6>
                        @endif

                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ url('product_details', $products->id) }}" class="btn btn-sm text-dark p-0"><i
                                class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <form action="{{ url('add_cart', $products->id) }}" method="POST">
                            @csrf
                            <div class="form-groub">
                                <input type="number" name="quantity" value="1" min="1" hidden>
                            </div>
                            <button href="" type="submit" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
<!-- Products End -->
