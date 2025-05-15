@extends('base')

@section('content')
    {{-- Hero --}}
    <section id="hero" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-5 fw-bold">Cari Laptop dengan Mudah</h1>
                    <p class="lead" style="color: gray">Temukan laptop second terbaik sesuai kebutuhanmu!</p>
                    <a href="#search" class="btn btn-primary btn-lg mt-3">Cari Laptop Sekarang</a>
                </div>
                <div class="col-lg-6">
                    {{-- Gambar Hero --}}
                    <img src="{{ asset('images/local/3dhero.png') }}" alt="Hero Image" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    {{-- Pencarian & Rekomendasi --}}
    <section id="search" class="rekomendasi">
        <div class="container text-center">
            <h2 class="mb-4">Pencarian Laptop</h2>

            <input type="text" name="keyword" id="keyword" class="form-control form-control-lg mb-4"
                placeholder="Cari berdasarkan merk, tipe, kebutuhan, dll...">

            {{-- Rekomendasi Laptop --}}
            <div class="row" id="searchResults">
                @include('partials.search_results', ['items' => $items])
            </div>
        </div>
    </section>

    {{-- Tentang Kami --}}
    <section id="tentang" class="tentang-kami position-relative text-white py-5">
        <div class="overlay"></div>
        <div class="container text-center position-relative">
            <h2 class="mb-4">Tentang Kami</h2>
            <p class="lead">Kami adalah platform rekomendasi laptop yang menyediakan solusi lengkap untuk kebutuhan
                laptop baru maupun second.
                Didukung oleh pengalaman The Master Computer Sukoharjo, kami berkomitmen menghadirkan pilihan terbaik
                yang sesuai dengan kebutuhan, anggaran, dan preferensimu..</p>
        </div>
    </section>
@endsection

@section('morejs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#keyword').on('keyup', function(e) {
            e.preventDefault();

            let keyword = $(this).val();

            $.ajax({
                url: '{{ route('search.ajax') }}',
                method: 'GET',
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('#searchResults').html(data);
                }
            });
        });
    </script>
@endsection
