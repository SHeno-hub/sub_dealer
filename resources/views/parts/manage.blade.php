@extends('layouts.app')

@section('title', 'Manage Parts Request')

@section('content')
    <h2>Manage Parts Request</h2>

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; background: #fff;">
        <thead>
            <tr>
                <th>#</th>
                <th>Request No.</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partsRequests as $index => $request)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $request['no'] ?? '-' }}</td>
                    <td>{{ $request['status'] ?? '-' }}</td>
                    <td>{{ $request['date'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">لا توجد بيانات حالياً</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection