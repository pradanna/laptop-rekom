@extends('admin.base')

@section('content')
    <div class="container pt-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/transactions">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
            </ol>
        </nav>

        {{-- Card Detail Transaksi --}}
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Transaksi</h5>
                <span
                    class="badge bg-{{ $transaction->status == 'selesai' ? 'success' : ($transaction->status == 'pembayaran ditolak' ? 'danger' : 'warning') }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
            <div class="card-body row">
                {{-- Informasi Pembeli --}}
                <div class="col-md-6">
                    <h6>Informasi Pembeli</h6>
                    <p><strong>Nama:</strong> {{ $transaction->member->name }}</p>
                    <p><strong>Email:</strong> {{ $transaction->member->email }}</p>
                    <p><strong>No. Telepon:</strong> {{ $transaction->member->phone }}</p>
                    <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y') }}</p>
                </div>

                {{-- Informasi Barang --}}
                <div class="col-md-6">
                    <h6>Detail Item</h6>
                    @foreach ($transaction->items as $transactionItem)
                        <div class="border rounded p-3 mb-4">
                            <p><strong>Nama:</strong> {{ $transactionItem->item->name }}</p>
                            <p><strong>Spesifikasi:</strong> {{ $transactionItem->item->processor }},
                                {{ $transactionItem->item->ram }},
                                {{ $transactionItem->item->storage }}{{ $transactionItem->item->gpu ? ', ' . $transactionItem->item->gpu : '' }}
                            </p>
                            <p><strong>Harga:</strong> Rp{{ number_format($transactionItem->item->price, 0, ',', '.') }}
                            </p>
                            <p><strong>Kondisi:</strong> {{ $transactionItem->item->condition }}</p>
                            <p><strong>Deskripsi:</strong> {{ $transactionItem->item->description }}</p>

                            @if ($transactionItem->item->image)
                                <img src="{{ asset('storage/' . $transactionItem->item->image) }}" alt="Gambar"
                                    class="img-fluid rounded mt-2" style="max-height: 250px;">
                            @else
                                <p class="text-muted">Tidak ada gambar</p>
                            @endif
                        </div>
                    @endforeach

                    {{-- Bukti Transfer --}}
                    <h6>Bukti Transfer</h6>
                    @if ($transaction->proof)
                        <a href="{{ asset('storage/' . $transaction->proof) }}" target="_blank"
                            class="btn btn-outline-primary mb-2">
                            Lihat Bukti Transfer
                        </a>
                    @else
                        <p class="text-muted">Belum ada bukti transfer</p>
                    @endif

                    <hr>
                    <div class="card-footer d-flex justify-content-end gap-2">
                        @if ($transaction->status === 'menunggu konfirmasi pembayaran')
                            {{-- Jika status pending, tampilkan tombol terima atau tolak pembayaran --}}
                            <form method="POST"
                                action="{{ route('admin.transactions.updateStatus', ['transaction' => $transaction->id, 'status' => 'diproses']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Terima Pembayaran</button>
                            </form>
                            <form method="POST"
                                action="{{ route('admin.transactions.updateStatus', ['transaction' => $transaction->id, 'status' => 'pembayaran ditolak']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Tolak Pembayaran</button>
                            </form>
                        @elseif ($transaction->status === 'diproses')
                            {{-- Jika status diproses, tampilkan tombol kirim pesanan --}}
                            <form method="POST"
                                action="{{ route('admin.transactions.updateStatus', ['transaction' => $transaction->id, 'status' => 'dikirim']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
                            </form>
                        @elseif ($transaction->status === 'dikirim')
                            {{-- Jika status dikirim, tampilkan tombol selesaikan pesanan --}}
                            <form method="POST"
                                action="{{ route('admin.transactions.updateStatus', ['transaction' => $transaction->id, 'status' => 'selesai']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Selesaikan Pesanan</button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>

            {{-- Aksi Admin --}}
            @if ($transaction->status === 'pending')
                <div class="card-footer d-flex justify-content-end gap-2">
                    <form method="POST"
                        action="{{ route('admin.transactions.updateStatus', ['transaction' => $transaction->id, 'status' => 'accepted']) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Terima Pesanan</button>
                    </form>
                    <form method="POST"
                        action="{{ route('admin.transactions.updateStatus', ['transaction' => $transaction->id, 'status' => 'rejected']) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
