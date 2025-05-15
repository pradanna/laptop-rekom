@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu overflow-hidden">
                <div class="title-container">
                    <p class="title">Daftar Transaksi</p>
                </div>

                {{-- Filter --}}
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
                <div class="mb-3">
                    <a href="{{ route('admin.transactions.export') }}" class="btn btn-success">
                        Export Excel
                    </a>
                </div>

                {{-- Tabel --}}
                <table class="table table-bordered table-striped" id="transactionTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Member</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $index => $transaction)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $transaction->member->name }}</td>
                                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $status = $transaction->status;
                                        $badgeClass = match ($status) {
                                            'menunggu pembayaran' => 'bg-secondary text-white',
                                            'menunggu konfirmasi pembayaran' => 'bg-warning text-dark',
                                            'diproses' => 'bg-primary text-white',
                                            'dikirim' => 'bg-info text-dark',
                                            'selesai' => 'bg-success text-white',
                                            'ditolak' => 'bg-danger text-white',
                                            default => 'bg-light text-muted',
                                        };

                                        // Ubah format tampilan status agar kapital di awal kata
                                        $label = ucwords($status);
                                    @endphp

                                    <span class="badge {{ $badgeClass }}">{{ $label }}</span>

                                </td>
                                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.transactions.show', $transaction->id) }}"
                                        class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- DataTables JS & CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#transactionTable').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
@endsection
