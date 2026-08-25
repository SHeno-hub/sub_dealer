@extends('layouts.app')

@section('title', 'New Vehicles Request')

@section('content')
<div class="request-page">

    <h2 class="page-title">Request Details</h2>

    <div class="request-card">
        <div class="field-grid">
            <div class="field">
                <label>Request Type <span class="req">*</span></label>
                <select disabled>
                    <option selected>Vehicle</option>
                </select>
            </div>

            <div class="field">
                <label>Request Date <span class="req">*</span></label>
                <input type="text" value="{{ now()->format('m/d/Y') }}" readonly>
            </div>

            <div class="field">
                <label>Payment Terms <span class="req">*</span></label>
                <select disabled>
                    <option selected>45 Net</option>
                </select>
            </div>

            <div class="total-box">
                <div class="total-title">Total</div>
                <div class="total-row">
                    <span>Total List Price</span>
                    <span>{{ number_format($totals['listPrice'] ?? 0, 0) }}</span>
                </div>
                <div class="total-row">
                    <span>Discount</span>
                    <span>{{ number_format($totals['discount'] ?? 0, 0) }}</span>
                </div>
                <div class="total-divider"></div>
                <div class="total-row">
                    <span>Total Net Price</span>
                    <span>{{ number_format($totals['netPrice'] ?? 0, 0) }}</span>
                </div>
                <div class="total-row">
                    <span>Total Tax</span>
                    <span>{{ number_format($totals['tax'] ?? 0, 0) }}</span>
                </div>
                <div class="total-divider"></div>
                <div class="total-row grand-total">
                    <span>Grand Total</span>
                    <span>{{ number_format($totals['grandTotal'] ?? 0, 0) }}</span>
                </div>
            </div>

            <div class="field">
                <label>Sub Dealer <span class="req">*</span></label>
                <input type="text" value="{{ $subDealer ?? 'Car Care Maintenance' }}" readonly>
            </div>

            <div class="field">
                <label>Sub Dealer Site <span class="req">*</span></label>
                <select>
                    <option selected disabled>Select Site</option>
                    @foreach($sites ?? ['Cairo - Main Branch', 'Alexandria Branch', 'Giza Branch'] as $site)
                        <option>{{ $site }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Request Delivery Date <span class="req">*</span></label>
                <input type="date">
            </div>

            <div class="field field-wide">
                <label>Comments</label>
                <textarea rows="1" placeholder="Add any comments here..."></textarea>
            </div>
        </div>
    </div>

    <div class="lines-header">
        <h2 class="page-title">
            Line(s) Details
            <button type="button" class="btn-add-line" title="Add Line" onclick="addLine()">
                <i class="bi bi-plus-lg"></i>
            </button>
        </h2>
        <button type="button" class="btn btn-export">Export</button>
    </div>

    <div class="table-wrap">
        <table class="lines-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item No.</th>
                    <th>Item Description</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Exterior Color</th>
                    <th>Interior Color</th>
                    <th>Quantity</th>
                    <th>Unit Total</th>
                    <th>Line Total</th>
                    <th>Availability Status</th>
                    <th>Requested Delivery Date</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody id="linesBody">
                {{-- Static sample rows - to be wired to real data by the front-end/backend later --}}
                @php
                    $lines = $lines ?? [
                        [
                            'itemNo' => 'VEH-1001',
                            'description' => 'Sedan 2.0L Automatic',
                            'brand' => 'Toyota',
                            'model' => 'Corolla',
                            'exteriorColor' => 'White',
                            'interiorColor' => 'Beige',
                            'quantity' => 1,
                            'unitTotal' => 0,
                            'lineTotal' => 0,
                            'availability' => 'Available',
                            'deliveryDate' => '',
                            'comment' => '',
                        ],
                    ];
                @endphp
                @forelse($lines as $index => $line)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $line['itemNo'] }}</td>
                        <td>{{ $line['description'] }}</td>
                        <td>{{ $line['brand'] }}</td>
                        <td>{{ $line['model'] }}</td>
                        <td>{{ $line['exteriorColor'] }}</td>
                        <td>{{ $line['interiorColor'] }}</td>
                        <td>{{ $line['quantity'] }}</td>
                        <td>{{ number_format($line['unitTotal'], 0) }}</td>
                        <td>{{ number_format($line['lineTotal'], 0) }}</td>
                        <td>
                            <span class="badge-status badge-{{ Str::slug($line['availability']) }}">
                                {{ $line['availability'] }}
                            </span>
                        </td>
                        <td>{{ $line['deliveryDate'] ?: '-' }}</td>
                        <td>{{ $line['comment'] ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="empty-row">No lines added yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="submit-row">
        <button type="button" class="btn btn-submit">Submit</button>
    </div>

</div>

<style>
    .request-page {
        font-family: 'Segoe UI', Arial, sans-serif;
        color: var(--ink);
    }

    .page-title {
        display: flex;
        align-items: center;
        color: #9a8f7a;
        font-weight: 600;
        font-size: 20px;
        margin: 0 0 14px;
    }

    .req { color: #e03131; }

    /* ---- Request Details card ---- */
    .request-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 10px;
        padding: 20px;
    }

    .field-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px 20px;
    }

    .field {
        display: flex;
        flex-direction: column;
    }

    .field-wide {
        grid-column: span 3;
    }

    .field label {
        font-size: 13px;
        font-weight: 600;
        color: #9a8f7a;
        margin-bottom: 6px;
    }

    .field input,
    .field select,
    .field textarea {
        font-family: inherit;
        font-size: 14px;
        color: var(--ink);
        background: #fbfaf8;
        border: 1px solid var(--line);
        border-radius: 6px;
        padding: 9px 12px;
        width: 100%;
        appearance: auto;
    }

    .field input[readonly] {
        background: #fbfaf8;
        color: var(--ink);
    }

    .field textarea {
        resize: vertical;
        min-height: 40px;
    }

    /* Total box spans two rows on the right column */
    .total-box {
        grid-row: span 2;
        grid-column: 3;
        border: 1px solid var(--line);
        border-radius: 8px;
        padding: 14px 18px;
        background: #fff;
        align-self: start;
    }

    .total-title {
        font-weight: 700;
        color: #9a8f7a;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #6b6459;
        padding: 4px 0;
    }

    .total-divider {
        border-top: 1px solid var(--line);
        margin: 6px 0;
    }

    .total-row.grand-total {
        color: var(--brand);
        font-weight: 700;
        font-size: 15px;
    }

    /* ---- Line(s) Details ---- */
    .lines-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 32px;
    }

    .btn-add-line {
        border: none;
        background: #eef2fb;
        color: var(--brand);
        width: 26px;
        height: 26px;
        border-radius: 6px;
        margin-left: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .btn {
        border: none;
        border-radius: 6px;
        padding: 9px 26px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-export,
    .btn-submit {
        background: var(--brand);
        color: #fff;
    }

    .btn-export:hover,
    .btn-submit:hover {
        background: var(--brand-dark);
    }

    .table-wrap {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 10px;
        margin-top: 14px;
        overflow-x: auto;
    }

    .lines-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .lines-table thead th {
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #9a8f7a;
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        white-space: nowrap;
    }

    .lines-table tbody td {
        padding: 12px 14px;
        font-size: 13.5px;
        color: #4a4640;
        border-bottom: 1px solid var(--line);
        white-space: nowrap;
    }

    .lines-table tbody tr:last-child td {
        border-bottom: none;
    }

    .empty-row {
        text-align: center;
        color: var(--muted);
        padding: 30px 0 !important;
    }

    .badge-status {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-available { background: #e6f6ea; color: #2f9e44; }
    .badge-out-of-stock { background: #fdecec; color: #e03131; }
    .badge-limited { background: #fff4e0; color: #f08c00; }

    .submit-row {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    @media (max-width: 900px) {
        .field-grid { grid-template-columns: 1fr 1fr; }
        .total-box { grid-column: span 2; grid-row: auto; }
        .field-wide { grid-column: span 2; }
    }

    @media (max-width: 560px) {
        .field-grid { grid-template-columns: 1fr; }
        .total-box { grid-column: 1; }
        .field-wide { grid-column: 1; }
    }
</style>

<script>
    // Placeholder client-side behavior only — no backend wiring yet (static data project).
    function addLine() {
        const tbody = document.getElementById('linesBody');
        const rowCount = tbody.querySelectorAll('tr').length;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${rowCount + 1}</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td><span class="badge-status badge-available">Available</span></td>
            <td>-</td>
            <td>-</td>
        `;
        tbody.appendChild(row);
    }
</script>
@endsection