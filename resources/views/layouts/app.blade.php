<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #e84343;
            --dark: #1a1a2e;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
        }

        /* Navbar */
        .navbar {
            background: var(--dark) !important;
        }

        .navbar-brand {
            color: var(--primary) !important;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .nav-link {
            color: #ccc !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary) !important;
        }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, var(--dark) 60%, var(--primary));
            color: #fff;
            padding: 60px 0;
        }

        /* Cards */
        .food-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
        }

        .food-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, .15);
        }

        .food-card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .food-card .badge {
            background: var(--primary);
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: #c73232;
            border-color: #c73232;
        }

        .section-title {
            border-left: 5px solid var(--primary);
            padding-left: 12px;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Detail */
        .detail-img {
            border-radius: 16px;
            max-height: 420px;
            object-fit: cover;
            width: 100%;
        }

        .price-tag {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* Form */
        .form-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
        }

        .form-label {
            font-weight: 600;
        }

        .required {
            color: var(--primary);
        }

        /* Alert */
        .alert-validation {
            border-left: 5px solid #dc3545;
        }

        footer {
            background: var(--dark);
            color: #aaa;
            padding: 30px 0;
            margin-top: 60px;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('restaurant.index') }}">
                🍽️ FoodViet
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('restaurant.index') ? 'active' : '' }}"
                            href="{{ route('restaurant.index') }}">Trang Chủ</a>
                    </li>
                    @foreach(['Cơm Dĩa', 'Bánh mỳ', 'Bú phở'] as $cat)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('category/' . urlencode($cat)) ? 'active' : '' }}"
                                href="{{ route('restaurant.category', $cat) }}">{{ $cat }}</a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('restaurant.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Thêm Món
                </a>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="text-center">
        <p class="mb-0">© {{ date('Y') }} FoodViet — Ẩm thực Việt Nam</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>