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
            <div class="col-md-8 grid-margin stretch-card" style="float: none; margin: auto; padding-top: 20px;">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Send Email</h4>
                  <p class="card-description"> Send Email to {{ $order->email }} </p>
                  <form class="forms-sample" action="{{ url('send_user_email', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Email Greeting :</label>
                      <textarea type="text" class="form-control" name="greeting" placeholder="Email Greeting"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Email First Line :</label>
                      <textarea type="text" class="form-control" name="firstline" placeholder="Email First Line"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Email Body :</label>
                      <textarea type="text" class="form-control" name="body" placeholder="Email Body"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Email Button Name :</label>
                      <input type="text" class="form-control" name="button" placeholder="Email Button Name">
                    </div>
                    <div class="form-group">
                      <label>Email Url :</label>
                      <input type="text" class="form-control" name="url" placeholder="Email Url">
                    </div>
                    <div class="form-group">
                      <label>Email Last Line :</label>
                      <textarea type="text" class="form-control" name="lastline" placeholder="Email Last Line"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Send Email</button>
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