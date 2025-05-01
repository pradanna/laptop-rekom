@extends('admin.base')

@section('content')
    <div class="dashboard">
        {{-- STATUS --}}
        <div class="status-container icon-circle">
            <a class="card-status color1" href="/admin/item">
                <div class="content">
                    <div class="stat">
                        <p class="title">Total Laptop</p>
                        <p class="val" id="totalItem">0</p>
                    </div>
                    <div class="report">
                        <p><span class="down" id="itemAktif">0</span> laptop tersedia.</p>
                    </div>
                </div>
                <div class="icon-container">
                    <span class="material-symbols-outlined">laptop_mac</span>
                </div>
            </a>

            <a class="card-status color2" href="/admin/transaction">
                <div class="content">
                    <div class="stat">
                        <p class="title">Total Transaksi</p>
                        <p class="val" id="totalTransaksi">0</p>
                    </div>
                    <div class="report">
                        <p><span class="down" id="transaksiBerhasil">0</span> transaksi berhasil.</p>
                    </div>
                </div>
                <div class="icon-container">
                    <span class="material-symbols-outlined">receipt_long</span>
                </div>
            </a>

            <a class="card-status color3" href="/admin/user">
                <div class="content">
                    <div class="stat">
                        <p class="title">Total Pembeli</p>
                        <p class="val" id="totalPembeli">0</p>
                    </div>
                    <div class="report">
                        <p><span class="down" id="pembeliAktif">0</span> user terdaftar.</p>
                    </div>
                </div>
                <div class="icon-container">
                    <span class="material-symbols-outlined">person</span>
                </div>
            </a>

            <a class="card-status color4" href="/admin/user?role=admin">
                <div class="content">
                    <div class="stat">
                        <p class="title">Total Admin</p>
                        <p class="val" id="totalAdmin">0</p>
                    </div>
                    <div class="report">
                        <p><span class="down" id="adminAktif">0</span> admin aktif.</p>
                    </div>
                </div>
                <div class="icon-container">
                    <span class="material-symbols-outlined">admin_panel_settings</span>
                </div>
            </a>
        </div>

        <!-- Tabel Data Laptop -->
        <div class="mt-5">
            <h2>Daftar Laptop</h2>

            <table id="itemTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>Penyimpanan</th>
                        <th>GPU</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->processor }}</td>
                            <td>{{ $item->ram }}</td>
                            <td>{{ $item->storage }}</td>
                            <td>{{ $item->gpu }}</td>
                            <td>{{ ucfirst($item->condition) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {
            $('#itemTable').DataTable();

            // Contoh manipulasi dashboard dari backend (pakai controller untuk isi ini via JS jika pakai AJAX)
            $('#totalItem').text("{{ $items->count() }}");
        });
    </script>
@endsection
