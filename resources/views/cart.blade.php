@extends('base')

@section('content')
    <section class="p-5 mt-5 container bg-white mb-5">
        <h2 class="mb-4 fw-bold">Keranjang Belanja</h2>

        @if ($cartItems->isEmpty())
            <div class="alert alert-info">Keranjang kamu masih kosong.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Laptop</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cart)
                        <tr>
                            <td>{{ $cart->item->name }}</td>
                            <td>Rp{{ number_format($cart->item->price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cart->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <h5>Total: <strong>Rp{{ number_format($cartItems->sum(fn($c) => $c->item->price), 0, ',', '.') }}</strong>
                </h5>
                <form action="{{ route('checkout.cart') }}" method="POST">
                    @csrf
                    <button class="btn btn-success">Checkout Sekarang</button>
                </form>
            </div>
        @endif
    </section>
@endsection
