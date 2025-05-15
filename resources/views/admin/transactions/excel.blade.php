<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Member</th>
            <th>Total</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $index => $transaction)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $transaction->member->name }}</td>
                <td>{{ $transaction->total }}</td>
                <td>{{ $transaction->status }}</td>
                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
