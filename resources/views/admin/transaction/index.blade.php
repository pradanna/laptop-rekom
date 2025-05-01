@extends('admin.base')

@section('content')
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Transactions</h1>

        <a href="{{ route('admin.transaction.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded">+ Add
            Transaction</a>

        <table class="w-full mt-4 border border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">User</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                    <tr>
                        <td class="border px-4 py-2">{{ $t->user->name }}</td>
                        <td class="border px-4 py-2">Rp{{ number_format($t->total) }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($t->status) }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('admin.transaction.edit', $t) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('admin.transaction.destroy', $t) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin?')" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
