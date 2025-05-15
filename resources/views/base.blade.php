<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laptop Rekom' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/genosstyle.v.06.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .site-footer {
            background-color: #f1f1f1;
            padding: 20px 10%;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
            margin-top: 50px;
        }

        .user-box {
            border: 1px solid #ddd;
            padding: 4px 10px;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.03);
            transition: background-color 0.2s;
        }

        .user-box:hover {
            background-color: rgba(0, 0, 0, 0.06);
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img style="height: 50px"
                    src="{{ asset('images/local/logo-panjang.png') }}" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link me-3 scroll-link" data-target="hero" href="#">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link me-3 scroll-link" data-target="search" href="#">Cari
                            Laptop</a></li>
                    <li class="nav-item"><a class="nav-link me-3 scroll-link" data-target="tentang"
                            href="#">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link me-3 scroll-link" data-target="kontak"
                            href="#">Kontak</a></li>

                    @auth
                        {{-- Jika user sudah login --}}
                        <li class="nav-item dropdown">
                            @php
                                $role = Auth::user()->role;
                                $dashboardUrl = $role === 'admin' ? '/admin' : '/user';
                                $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                            @endphp

                            <a class="nav-link dropdown-toggle user-box" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                👤 {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center"
                                        href="{{ route('cart.index') }}">
                                        Keranjang
                                        @if ($cartCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $cartCount }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('transaction.index') }}">Daftar Transaksi</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- Jika user belum login --}}
                        <li class="nav-item">
                            <a class="btn btn-primary text-white ms-2" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    {{-- Content Placeholder --}}
    <div style="padding-top: 80px;">
        @yield('content')
    </div>

    <div class="contact pt-5" id="kontak">
        <h2 class="mb-3">KONTAK KAMI</h2>
        <div class="contact-card">
            <div class="header">The Master Computer</div>

            <div class="info">
                <span class="material-symbols-outlined icon-text">location_on</span>
                <p>Computer service in Sukoharjo, Central Java</p>
            </div>
            <div class="divider"></div>

            <div class="info">
                <span class="material-symbols-outlined icon-text">home</span>
                <p>Address: Jalan Mayor Sunaryo No.30, Jetis, Gawanan, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo,
                    Jawa Tengah 57511</p>
            </div>
            <div class="divider"></div>

            <div class="info">
                <span class="material-symbols-outlined icon-text">phone</span>
                <p>Phone: 0817-2850-770</p>
            </div>
            <div class="divider"></div>

            <div class="info">
                <span class="material-symbols-outlined icon-text">access_time</span>
                <p>Hours: Closed ⋅ Opens 8.00 am Wed</p>
            </div>
            <div class="divider"></div>

            <div class="info">
                <span class="material-symbols-outlined icon-text">map</span>
                <p>Province: Central Java</p>
            </div>
        </div>
    </div>

    <!-- Contact Map -->
    <div class="contact-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.045614930753!2d110.8380061!3d-7.678245400000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a3c6e6e5d1c77%3A0x3271ce4616b7e04a!2sThe%20Master%20Computer!5e0!3m2!1sen!2sid!4v1746542588457!5m2!1sen!2sid"
            width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    {{-- Footer --}}
    <footer class="site-footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} The Master Computer. All rights reserved.</p>
        </div>
    </footer>

    {{-- Bootstrap Script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const baseUrl = "{{ url('/') }}";

            document.querySelectorAll('.scroll-link').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const target = link.getAttribute('data-target');

                    // Kalau di halaman utama, langsung scroll
                    if (window.location.pathname === '/' || window.location.pathname === '') {
                        const el = document.getElementById(target);
                        if (el) {
                            el.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    } else {
                        // Kalau bukan di halaman utama, redirect ke halaman utama dengan hash
                        window.location.href = `${baseUrl}/#${target}`;
                    }
                });
            });

            // Scroll otomatis jika ada hash di URL setelah load
            const hash = window.location.hash;
            if (hash) {
                const el = document.querySelector(hash);
                if (el) {
                    setTimeout(() => {
                        el.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }, 300);
                }
            }
        });
    </script>
    @yield('morejs')
</body>

</html>
