@extends('layouts.app')

@section('title', 'Manage Parts Request')

@section('content')

    <style>
        .mv-page h2 {
            margin: 0 0 20px;
            font-size: 26px;
            color: var(--ink);
        }

        .mv-filters {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px 20px;
            margin-bottom: 20px;
        }

        .mv-field {
            display: flex;
            flex-direction: column;
        }

        .mv-field label {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .mv-field select,
        .mv-field input {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            color: var(--ink);
            background: #fff;
            font-family: inherit;
        }

        .mv-field select:focus,
        .mv-field input:focus {
            outline: none;
            border-color: var(--brand);
        }

        .mv-actions-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 40px;
        }

        .mv-export-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 0;
        }

        .btn-brand {
            border: none;
            background: var(--brand);
            color: #fff;
            padding: 10px 26px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-brand:hover { background: var(--brand-dark); }

        .mv-table-wrap {
            overflow-x: auto;
            border-radius: 10px;
            margin-top: 14px;
        }

        table.mv-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        table.mv-table thead th {
            background: var(--bg);
            color: var(--brand-dark);
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            padding: 14px 16px;
            white-space: nowrap;
        }

        table.mv-table tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--ink);
            border-top: 1px solid var(--line);
        }

        table.mv-table tbody tr:hover {
            background: #fafbfc;
        }

        .mv-empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 30px 16px;
        }
    </style>

    <div class="mv-page">
        <h2>Search</h2>

        @php
            // Static reference data — no backend wired up yet
            $subDealerSites = ['Main Site', 'Branch 1', 'Branch 2'];
            $requestStatuses = ['Pending', 'Approved', 'Rejected'];
        @endphp

        <form method="GET" action="{{ route('parts.manage') }}">
            <div class="mv-filters">
                <div class="mv-field">
                    <label>Sub Dealer Site</label>
                    <select name="sub_dealer_site">
                        <option value="">Select site</option>
                        @foreach ($subDealerSites as $site)
                            <option value="{{ $site }}">{{ $site }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mv-field">
                    <label>Request Type</label>
                    <select name="request_type" disabled>
                        <option selected>Spare Part</option>
                    </select>
                </div>

                <div class="mv-field">
                    <label>Payment Terms</label>
                    <select name="payment_terms" disabled>
                        <option selected>45 Net</option>
                    </select>
                </div>

                <div class="mv-field">
                    <label>Request Date</label>
                    <input type="date" name="request_date">
                </div>

                <div class="mv-field">
                    <label>Request Status</label>
                    <select name="request_status">
                        <option value="">All statuses</option>
                        @foreach ($requestStatuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mv-field">
                    <label>Request No.</label>
                    <input type="text" name="request_no" placeholder="Request No.">
                </div>
            </div>

            <div class="mv-actions-row">
                <button type="submit" class="btn-brand">Search</button>
            </div>
        </form>

        <div class="mv-export-row">
            <button type="button" class="btn-brand">Export</button>
        </div>

        <div class="mv-table-wrap">
            <table class="mv-table">
                <thead>
                    <tr>
                        <th>Request No.</th>
                        <th>Request Type</th>
                        <th>Request Date</th>
                        <th>Sub Dealer</th>
                        <th>Sub Dealer Site</th>
                        <th>Payment Term</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partsRequests ?? [] as $request)
                        <tr>
                            <td>{{ $request['no'] ?? '-' }}</td>
                            <td>{{ $request['type'] ?? 'Spare Part' }}</td>
                            <td>{{ $request['date'] ?? '-' }}</td>
                            <td>{{ $request['sub_dealer'] ?? '-' }}</td>
                            <td>{{ $request['sub_dealer_site'] ?? '-' }}</td>
                            <td>{{ $request['payment_term'] ?? '-' }}</td>
                            <td>{{ $request['status'] ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr class="mv-empty-row">
                            <td colspan="7">لا توجد بيانات حالياً</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection