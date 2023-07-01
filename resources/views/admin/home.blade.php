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
      @include('admin.body')
      <!-- End Main Panel -->

    <!-- container-scroller -->
    @include('admin.script')
  </body>
</html>