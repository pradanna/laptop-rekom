@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu overflow-hidden">
                <div class="title-container">
                    <p class="title">Inbox</p>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Data Item</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Item</button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped" id="itemTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Spesifikasi</th>
                            <th>Harga</th>
                            <th>Status</th> <!-- Kolom baru -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->processor }}, {{ $item->ram }},
                                    {{ $item->storage }}{{ $item->gpu ? ', ' . $item->gpu : '' }}</td>
                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->isSold)
                                        <span class="badge bg-danger bg-opacity-25 text-danger">Terjual</span>
                                    @else
                                        <span class="badge bg-success bg-opacity-25 text-success">In Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $item->id }}">Detail</button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">Edit</button>
                                    <form action="{{ route('admin.item.destroy', $item->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin hapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                {{-- Modal Edit --}}
                @foreach ($items as $item)
                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content" action="{{ route('admin.item.update', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        {{-- Kolom Kiri --}}
                                        <div class="col-md-6">
                                            <div class="mb-3"><label>Nama</label>
                                                <input type="text" name="name" value="{{ $item->name }}"
                                                    class="form-control" required>
                                            </div>
                                            <div class="mb-3"><label>Processor</label>
                                                <input type="text" name="processor" value="{{ $item->processor }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3"><label>RAM</label>
                                                <input type="text" name="ram" value="{{ $item->ram }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3"><label>Storage</label>
                                                <input type="text" name="storage" value="{{ $item->storage }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3"><label>GPU</label>
                                                <input type="text" name="gpu" value="{{ $item->gpu }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3"><label>Harga</label>
                                                <input type="number" name="price" value="{{ $item->price }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        {{-- Kolom Kanan --}}
                                        <div class="col-md-6">
                                            <div class="mb-3"><label>Kondisi</label>
                                                <input type="text" name="condition" value="{{ $item->condition }}"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3"><label>Deskripsi</label>
                                                <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                                            </div>
                                            <div class="mb-3"><label>Keyword</label>
                                                <textarea name="keyword" class="form-control">{{ $item->keyword }}</textarea>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" name="isSold"
                                                    value="1" {{ $item->isSold ? 'checked' : '' }}>
                                                <label class="form-check-label">Tandai sebagai Terjual</label>
                                            </div>
                                            <div class="mb-3"><label>Gambar (upload baru jika ingin ganti)</label>
                                                <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="modal-content" action="{{ route('admin.item.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6">
                            <div class="mb-3"><label>Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3"><label>Processor</label>
                                <input type="text" name="processor" class="form-control">
                            </div>
                            <div class="mb-3"><label>RAM</label>
                                <input type="text" name="ram" class="form-control">
                            </div>
                            <div class="mb-3"><label>Storage</label>
                                <input type="text" name="storage" class="form-control">
                            </div>
                            <div class="mb-3"><label>GPU</label>
                                <input type="text" name="gpu" class="form-control">
                            </div>
                            <div class="mb-3"><label>Harga</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-md-6">
                            <div class="mb-3"><label>Kondisi</label>
                                <input type="text" name="condition" class="form-control">
                            </div>
                            <div class="mb-3"><label>Deskripsi</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="mb-3"><label>Keyword</label>
                                <textarea name="keyword" class="form-control"></textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" name="isSold" value="1">
                                <label class="form-check-label">Tandai sebagai Terjual</label>
                            </div>
                            <div class="mb-3"><label>Gambar</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>


        </div>
    </div>

    @foreach ($items as $item)
        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Detail Item: {{ $item->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body bg-light">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nama:</strong> {{ $item->name }}</li>
                                    <li class="list-group-item"><strong>Processor:</strong> {{ $item->processor }}</li>
                                    <li class="list-group-item"><strong>RAM:</strong> {{ $item->ram }}</li>
                                    <li class="list-group-item"><strong>Storage:</strong> {{ $item->storage }}</li>
                                    <li class="list-group-item"><strong>GPU:</strong> {{ $item->gpu ?? '-' }}</li>
                                    <li class="list-group-item"><strong>Harga:</strong>
                                        Rp{{ number_format($item->price, 0, ',', '.') }}</li>
                                    <li class="list-group-item"><strong>Kondisi:</strong> {{ $item->condition }}</li>
                                    <li class="list-group-item"><strong>Deskripsi:</strong><br>{{ $item->description }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Status:</strong>
                                        @if ($item->isSold)
                                            <span class="badge bg-danger bg-opacity-25 text-danger">Terjual</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-25 text-success">In Stock</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-start">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                        class="img-fluid rounded shadow-sm w-100"
                                        style="max-height: 350px; object-fit: contain;">
                                @else
                                    <div class="alert alert-secondary w-100 text-center">Tidak ada gambar</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
        });
    </script>
@endif

@section('morejs')
    <script>
        $(document).ready(function() {
            $('#itemTable').DataTable();
        });
    </script>
@endsection
