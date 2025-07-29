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
      @include ('layouts._partials.navbar')
      <div class="container-fluid page-body-wrapper">
        @include ('layouts._partials.sidebar')
        <div class="main-panel">
          <div class="content-wrapper">
            @yield('content')
          </div>
          @include ('layouts._partials.footer')
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('logout-notif').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Logout?',
                text: "Are you sure to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
        });
    </script>

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