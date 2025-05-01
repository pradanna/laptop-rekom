@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu overflow-hidden">
                <div class="title-container">
                    <p class="title">Detail Member</p>
                </div>

                <div class="card p-4">
                    <h4>Nama: {{ $member->name }}</h4>
                    <p><strong>Email:</strong> {{ $member->email }}</p>
                    <p><strong>Telepon:</strong> {{ $member->phone }}</p>
                    <p><strong>Alamat:</strong> {{ $member->address }}</p>
                    <p><strong>Akun User:</strong> {{ $member->user->name ?? '-' }}</p>

                    <a href="{{ route('admin.member.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
