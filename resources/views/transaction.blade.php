@extends('base')

@section('content')
    <div class="container  p-5">
        <h3 class="mb-4">Checkout & Pembayaran</h3>

        <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                {{-- Kiri: Daftar Item --}}
                <div class="col-md-8">
                    <h5>Daftar Item:</h5>
                    <ul class="list-group mb-3">
                        @foreach ($carts as $cart)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $cart->item->name }} (x{{ $cart->qty }})
                                <span>Rp{{ number_format($cart->item->price * $cart->qty, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
                        </li>
                    </ul>
                </div>

                {{-- Kanan: Info Transfer dan Upload --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Total yang Harus Dibayar</h5>
                            <p class="h4 text-success fw-bold">Rp{{ number_format($total, 0, ',', '.') }}</p>

                            <hr>

                            <h6>Transfer ke rekening:</h6>
                            <ul class="mb-3">
                                <li>🏦 BCA - <strong>1234567890</strong> a.n. The Master Computer</li>
                                <li>🏦 Mandiri - <strong>0987654321</strong> a.n. The Master Computer</li>
                            </ul>

                            <div class="mb-3">
                                <label for="proof" class="form-label">Upload Bukti Transfer</label>
                                <input type="file" class="form-control" name="proof" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Kirim Pembayaran</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
