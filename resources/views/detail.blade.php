@extends('base')

@section('content')
    <section class="py-5 mt-5">
        <div class="container">
            <div class="row">
                {{-- Gambar --}}
                <div class="col-md-6">
                    <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/local/defaultlaptop.jpg') }}"
                        alt="{{ $item->name }}" class="img-fluid rounded shadow-sm" style="object-fit: cover;">
                </div>

                {{-- Detail --}}
                <div class="col-md-6">
                    <h2 class="fw-bold">{{ $item->name }}</h2>
                    <p class="text-muted mb-2">Kondisi: <strong>{{ ucfirst($item->condition) }}</strong></p>
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <p class="text-success h4 fw-bold mb-3">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        @if ($item->isSold)
                            <span class="bg-danger rounded-pill px-2 text-white">Terjual</span>
                        @else
                            <span class="bg-success rounded-pill px-2 text-white">Tersedia</span>
                        @endif
                    </div>

                    <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Processor:</strong> {{ $item->processor }}</li>
                        <li class="list-group-item"><strong>RAM:</strong> {{ $item->ram }}</li>
                        <li class="list-group-item"><strong>Storage:</strong> {{ $item->storage }}</li>
                        <li class="list-group-item"><strong>GPU:</strong> {{ $item->gpu }}</li>

                    </ul>

                    <p>{{ $item->description }}</p>

                    @if (!$item->isSold)
                        <div class="d-flex gap-2">
                            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-primary rounded-pill">Masukkan Keranjang</button>
                            </form>


                        </div>
                    @else
                        <div class="alert alert-danger mt-3">Laptop ini sudah terjual.</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
