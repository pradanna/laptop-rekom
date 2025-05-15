@forelse($items as $item)
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="position-relative">
                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/local/defaultlaptop.jpg') }}"
                    alt="{{ $item->name }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;">

                @if ($item->isSold)
                    <span
                        class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 small rounded-end-bottom">
                        Terjual
                    </span>
                @else
                    <span
                        class="position-absolute top-0 start-0 bg-success text-white px-3 py-1 small rounded-end-bottom">
                        Tersedia
                    </span>
                @endif
            </div>

            <div class="card-body">
                <h5 class="card-title text-truncate">{{ $item->name }}</h5>

                {{-- Tampilkan skor jika ada --}}
                @if (isset($item->score))
                    <div class="mb-1">
                        <small class="text-muted">Skor Rekomendasi:
                            <span class="fw-semibold text-dark">{{ number_format($item->score, 2) }}</span>
                        </small>
                    </div>
                @endif

                <p class="fw-bold text-success">Rp{{ number_format($item->price, 0, ',', '.') }}</p>

                <a href="{{ route('item.show', $item->id) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">Tidak ada rekomendasi tersedia saat ini.</p>
@endforelse
