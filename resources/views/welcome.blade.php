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
        .blog-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card {
            height: 100%;
            min-height: 420px;
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

    <section id="articles" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Artikel Terbaru</h2>
            <div class="row g-4 justify-content-left">
                @forelse ($blog as $blogs)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="card shadow-sm w-100 d-flex flex-column">
                            <img src="{{ asset('assets/images/' . $blogs->image) }}" class="card-img-top img-fluid blog-img">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $blogs->title }}</h5>
                                <p class="card-text">{!! \Illuminate\Support\Str::limit($blogs->description, 100) !!}</p>
                                <a href="{{ route('blogarticle', $blogs) }}" class="btn btn-primary mt-auto">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No articles available.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $blog->links() }}
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
