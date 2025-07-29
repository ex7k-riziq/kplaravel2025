<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CelestialUI Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.1.2/typicons.min.css">
    <link rel="stylesheet" href="{{ url('assets/css/typicons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>
    
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-1 px-4 px-sm-5">
                <div class="card-body">
                    <h2 class="card-title py-3">Add new category</h2>

                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <form class="forms-sample" method="POST" action="{{ route('dashboard.categorystore') }}" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group">
                          <label for="name">Title</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Category name">
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('dashboard.category') }}" class="btn btn-light">Cancel</a>
                    </form>
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
    <script src="{{ url('assets/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('assets/js/template.js') }}"></script>
    <script src="{{ url('assets/js/settings.js') }}"></script>
    <script src="{{ url('assets/js/todolist.js') }}"></script>
    <script src="{{ url('assets/js//progressbar.min.js') }}"></script>
    <script src="{{ url('assets/js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    </body>
 </html>