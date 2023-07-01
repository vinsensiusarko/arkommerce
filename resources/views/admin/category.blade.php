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

                <div class="col-lg-8 grid-margin stretch-card" style="float: none; margin: auto; padding-top: 20px;">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add Category</h4>
                      <p class="card-description"> Add Category To Arkommerce System </p>
                      <form class="forms-sample" action="{{ url('/add_category') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="exampleInputName1">Category Name</label>
                          <input type="text" class="form-control" name="category" placeholder="Category">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Add Category</button>
                        <button class="btn btn-dark" type="reset">Reset</button>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="col-lg-8 grid-margin stretch-card" style="float:none;margin:auto;padding-top:20px;">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title text-center">List Category</h4>
                        <!-- <p class="card-description"> Add class <code>.table</code></p> -->
                        <div class="table-responsive text-center">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Category Name</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->category_name }}</td>
                                <td><a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{ url('delete_category', $data->id) }}">Delete</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
        </div>
        <!-- End Main Panel -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
  </body>
</html>