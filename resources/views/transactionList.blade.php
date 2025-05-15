@extends('base')

@section('content')
    <div class="container mt-4">
        <h3>Daftar Transaksi</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse($transactions as $transaction)
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>No. Transaksi: #{{ $transaction->id }}</strong>
                    @php
                        $status = $transaction->status;
                        $color = match ($status) {
                            'menunggu pembayaran' => 'text-secondary',
                            'menunggu konfirmasi pembayaran' => 'text-warning',
                            'diproses' => 'text-primary',
                            'dikirim' => 'text-info',
                            'selesai' => 'text-success',
                            default => 'text-muted',
                        };
                    @endphp

                    <span class="{{ $color }} text-capitalize">{{ $status }}</span>

                </div>

                <div class="card-body">
                    <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>

                    <h6 class="mb-2">Daftar Item:</h6>
                    <ul class="list-group mb-3">
                        @foreach ($transaction->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->item->name }} (x{{ $item->qty }})
                                <span>Rp{{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>Rp{{ number_format($transaction->total, 0, ',', '.') }}</strong>
                        </li>
                    </ul>

                    @if ($transaction->proof)
                        <a href="{{ asset('storage/' . $transaction->proof) }}" target="_blank"
                            class="btn btn-sm btn-outline-success">
                            Lihat Bukti Transfer
                        </a>
                    @else
                        <p class="text-muted">Belum upload bukti transfer.</p>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada transaksi.</div>
        @endforelse
    </div>
@endsection
