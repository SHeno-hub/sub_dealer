@extends('layouts.app')

@section('title', 'New Vehicles Request')

@section('content')

    <style>
        .rv-page h2 {
            margin: 0 0 20px;
            font-size: 26px;
            color: var(--ink);
        }

        .rv-section-title {
            font-size: 22px;
            color: var(--ink);
            margin: 30px 0 16px;
        }

        .rv-details {
            display: flex;
            gap: 20px;
            align-items: stretch;
        }

        .rv-form {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px 20px;
        }

        .rv-field {
            display: flex;
            flex-direction: column;
        }

        .rv-field.rv-span-3 {
            grid-column: 1 / -1;
        }

        .rv-field label {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .rv-field label .req {
            color: #c0392b;
        }

        .rv-field select,
        .rv-field input,
        .rv-field textarea {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
            color: var(--ink);
            background: #fff;
            font-family: inherit;
        }

        .rv-field select:focus,
        .rv-field input:focus,
        .rv-field textarea:focus {
            outline: none;
            border-color: var(--brand);
        }

        .rv-field textarea {
            resize: vertical;
            min-height: 60px;
        }

        .rv-totals {
            width: 260px;
            flex-shrink: 0;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 16px 18px;
            background: #fff;
            align-self: flex-start;
        }

        .rv-totals h4 {
            margin: 0 0 10px;
            font-size: 15px;
            color: var(--ink);
        }

        .rv-totals .rv-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: var(--muted);
            padding: 6px 0;
        }

        .rv-totals .rv-row.rv-total-final {
            border-top: 1px solid var(--line);
            margin-top: 6px;
            padding-top: 10px;
            font-weight: 700;
            color: var(--brand);
        }

        .rv-lines-head {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .rv-add-btn {
            border: none;
            background: var(--ink);
            color: #fff;
            width: 26px;
            height: 26px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }

        .rv-lines-toolbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .btn-brand {
            border: none;
            background: var(--brand);
            color: #fff;
            padding: 10px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-brand:hover { background: var(--brand-dark); }

        .rv-table-wrap {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: #fff;
        }

        table.rv-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
        }

        table.rv-table thead th {
            background: var(--bg);
            color: var(--muted);
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            padding: 12px 14px;
            border-bottom: 1px solid var(--line);
            white-space: nowrap;
        }

        table.rv-table tbody td {
            padding: 10px 14px;
            font-size: 14px;
            border-bottom: 1px solid var(--line);
        }

        table.rv-table tbody td input,
        table.rv-table tbody td select {
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 6px 8px;
            font-size: 13px;
            width: 100%;
            min-width: 90px;
        }

        .rv-empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 30px 14px;
        }

        .rv-submit-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }
    </style>

    <div class="rv-page">
        <h2>Request Details</h2>

        @php
            // Static reference data — no backend wired up yet
            $paymentTerms = ['30 Net', '45 Net', '60 Net'];
            $subDealerSites = ['Main Site', 'Branch 1', 'Branch 2'];
            $subDealerName = 'Car Care Maintenance';
        @endphp

        <div class="rv-details">
            <div class="rv-form">
                <div class="rv-field">
                    <label>Request Type <span class="req">*</span></label>
                    <select name="request_type">
                        <option value="vehicle" selected>Vehicle</option>
                    </select>
                </div>

                <div class="rv-field">
                    <label>Request Date <span class="req">*</span></label>
                    <input type="text" name="request_date" value="{{ now()->format('m/d/Y') }}" readonly>
                </div>

                <div class="rv-field">
                    <label>Payment Terms <span class="req">*</span></label>
                    <select name="payment_terms">
                        @foreach ($paymentTerms as $term)
                            <option value="{{ $term }}" @selected($term === '45 Net')>{{ $term }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="rv-field">
                    <label>Sub Dealer <span class="req">*</span></label>
                    <input type="text" name="sub_dealer" value="{{ $subDealerName }}" readonly>
                </div>

                <div class="rv-field">
                    <label>Sub Dealer Site <span class="req">*</span></label>
                    <select name="sub_dealer_site">
                        <option value="">Select site</option>
                        @foreach ($subDealerSites as $site)
                            <option value="{{ $site }}">{{ $site }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="rv-field">
                    <label>Request Delivery Date <span class="req">*</span></label>
                    <input type="date" name="request_delivery_date">
                </div>

                <div class="rv-field rv-span-3">
                    <label>Comments</label>
                    <textarea name="comments" placeholder="Add any comments..."></textarea>
                </div>
            </div>

            <div class="rv-totals">
                <h4>Total</h4>
                <div class="rv-row"><span>Total List Price</span><span>0</span></div>
                <div class="rv-row"><span>Discount</span><span>0</span></div>
                <div class="rv-row"><span>Total Net Price</span><span>0</span></div>
                <div class="rv-row"><span>Total Tax</span><span>0</span></div>
                <div class="rv-row rv-total-final"><span>Grand Total</span><span>0</span></div>
            </div>
        </div>

        <div class="rv-lines-head">
            <h2 class="rv-section-title" style="margin:0;">Line(s) Details</h2>
            <button type="button" class="rv-add-btn" onclick="addLineRow()"><i class="bi bi-plus"></i></button>
        </div>

        <div class="rv-lines-toolbar">
            <button type="button" class="btn-brand">Export</button>
        </div>

        <div class="rv-table-wrap">
            <table class="rv-table">
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
                <tbody id="rvLinesBody">
                    <tr class="rv-empty-row">
                        <td colspan="13">No lines added yet. Click the "+" icon above to add a line.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="rv-submit-row">
            <button type="button" class="btn-brand">Submit</button>
        </div>
    </div>

    <script>
        let rvLineCount = 0;

        function addLineRow() {
            const body = document.getElementById('rvLinesBody');
            const emptyRow = body.querySelector('.rv-empty-row');
            if (emptyRow) emptyRow.remove();

            rvLineCount++;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${rvLineCount}</td>
                <td><input type="text" name="lines[${rvLineCount}][item_no]"></td>
                <td><input type="text" name="lines[${rvLineCount}][description]"></td>
                <td><input type="text" name="lines[${rvLineCount}][brand]"></td>
                <td><input type="text" name="lines[${rvLineCount}][model]"></td>
                <td><input type="text" name="lines[${rvLineCount}][exterior_color]"></td>
                <td><input type="text" name="lines[${rvLineCount}][interior_color]"></td>
                <td><input type="number" name="lines[${rvLineCount}][quantity]" value="1" min="1"></td>
                <td><input type="number" name="lines[${rvLineCount}][unit_total]" value="0"></td>
                <td><input type="number" name="lines[${rvLineCount}][line_total]" value="0" readonly></td>
                <td><input type="text" name="lines[${rvLineCount}][availability_status]"></td>
                <td><input type="date" name="lines[${rvLineCount}][requested_delivery_date]"></td>
                <td><input type="text" name="lines[${rvLineCount}][comment]"></td>
            `;
            body.appendChild(row);
        }
    </script>

@endsection