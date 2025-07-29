<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CelestialUI Admin</title>
    <link rel="shortcut icon" href="images/favicon.png" />
    <script src="https://kit.fontawesome.com/830b619a70.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .blog-detail-img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 70%;
            max-height: 300px;
            object-fit: fill;
        }

        @media (max-width: 768px) {
        .blog-detail-img {
            width: 80%;
        }
    }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm py-2 py-lg-3" style="background: #1882d8;">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="{{ route('welcome') }}">SLOPPY BLOG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-items-center gap-3 mt-3 mt-lg-0" id="mainNavbar">
                <ul class="navbar-nav me-3">
                    <li class="nav-item">
                        <a class="nav-link link-light" href="https://test-sloppy-vercel.vercel.app">Main</a>
                    </li>
                    @guest
                    <li class="nav-item">
                       <a class="nav-link link-light" href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link link-light" href="{{ route('dashboard.index') }}">Admin</a>
                    </li>
                    @endguest
                </ul>

                <form action="{{ route('welcome') }}" method="GET" class="d-flex flex-column flex-sm-row gap-2 w-30 w-sm-auto">
                    <input type="text" class="form-control me-sm-2" name="search" placeholder="Search" aria-label="Search" value="{{ request('search') }}">
                    <button class="btn btn-info" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </nav>

        <section id="main">
            <div class="inner">
                <main role="main" class="container mt-5 mb-5">
                    <div class="container">
                        <img src="{{ asset('assets/images/' . $blog->image) }}" class="blog-detail-img mx-auto d-block">
                    </div>
                    <h1 class="mt-5">{{ $blog->title }}</h1>
                    <h5 class="lead">{!!$blog->description!!}</h5>
                    <p>{{ $blog->category->name ?? '-' }} of {{ $blog->creator->name ?? '-' }}</p>
                    <p>Created at {{ $blog->created_at }}</p>
                </main>
                <div class="container">
                    <p>Nullam posuere erat vel placerat rutrum. Praesent ac consectetur dui, et congue quam. Donec aliquam lacinia condimentum. Integer porta massa sapien, commodo sodales diam suscipit vitae. Aliquam quis felis sed urna semper semper. Phasellus eu scelerisque mi. Vivamus aliquam nisl libero, sit amet scelerisque ligula laoreet vel. Nunc ullamcorper ipsum at diam congue luctus. Sed nec sapien blandit, tempor quam non, consectetur turpis. Morbi libero lorem, hendrerit sed metus non, malesuada placerat nulla. Sed nisi turpis, rutrum eget rutrum euismod, consequat ullamcorper eros. Quisque tortor nunc, sodales convallis nisl non, bibendum tincidunt tortor. Etiam pellentesque tincidunt nunc, a dignissim dolor tempus et. Pellentesque in urna ligula. Fusce ligula velit, mollis ac diam non, rutrum fringilla turpis.</p>
                    <p>Aliquam consequat, nulla sed sodales convallis, sem odio porttitor justo, non volutpat augue libero eget neque. Nunc consequat arcu nec tortor venenatis tempus a placerat mauris. Nam ultricies consequat ligula, et placerat arcu ultrices a. Sed placerat ipsum lacus, at imperdiet nisi imperdiet at. Vivamus diam dui, accumsan quis lacinia ac, sollicitudin feugiat metus. Vestibulum a velit ac eros blandit molestie non eget erat. Nunc eget odio erat. Nulla sit amet enim pharetra tortor molestie tempor nec sed turpis. Cras eget odio at erat dictum tincidunt. Sed facilisis convallis mi, eget tempor nunc pellentesque pulvinar. Etiam volutpat luctus tristique.</p>
                    <p>Aliquam erat eros, pretium non facilisis id, mollis a lacus. Nam nunc nisl, consequat at est vel, ornare feugiat tortor. Phasellus tempor ex vel mi blandit convallis. Sed accumsan sapien quis bibendum posuere. Vivamus convallis mattis ipsum. Suspendisse viverra purus non mi cursus, vitae pulvinar dui condimentum. Donec dui lacus, pretium in neque vitae, laoreet tempus nulla. Maecenas ac augue bibendum, consectetur ante eu, vulputate ipsum.</p>
                    <p>Nullam volutpat, sem at hendrerit volutpat, magna orci facilisis purus, et venenatis sapien sapien pretium libero. Duis hendrerit eget metus at molestie. Duis leo lorem, interdum a placerat ut, ullamcorper at eros. Donec convallis auctor cursus. Integer placerat felis mauris, sed cursus diam sodales et. Phasellus mi nibh, scelerisque vulputate viverra ut, dictum vitae mi. In at blandit felis. Aenean id porttitor neque. Nam bibendum a orci non pretium. Pellentesque feugiat erat augue, quis venenatis diam mollis eu.</p>
                </div>
            </div>
        </section>

    <footer class="py-3 my-4">
        <p class="text-center text-body-secondary">
           KP Riziq Ashiddiqi 2025.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>