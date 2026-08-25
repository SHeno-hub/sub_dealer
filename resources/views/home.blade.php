@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h2 style="margin: 0 0 4px; font-size: 24px;">Welcome</h2>
    <p style="margin: 0 0 28px; color: #6b7684; font-size: 14px;">Choose where you'd like to go</p>

    <style>
        .tile-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
        }

        .tile {
            background: #fff;
            border: 1px solid #e7eaee;
            border-radius: 14px;
            padding: 34px 20px;
            text-align: center;
            text-decoration: none;
            color: #22262b;
            box-shadow: 0 2px 6px rgba(20, 30, 45, .04);
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        }

        .tile:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(20, 30, 45, .10);
            border-color: transparent;
        }

        .tile .icon-circle {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 30px;
            color: #fff;
        }

        .tile .label {
            font-size: 15px;
            font-weight: 600;
        }

        .tile-blue .icon-circle { background: #1a73c7; }
        .tile-teal .icon-circle { background: #0f9b8e; }
        .tile-green .icon-circle { background: #2f9e44; }
        .tile-amber .icon-circle { background: #d98c1a; }

        @media (max-width: 900px) {
            .tile-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 520px) {
            .tile-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="tile-grid">
        <a href="{{ route('parts.new') }}" class="tile tile-blue">
            <span class="icon-circle"><i class="bi bi-box-seam"></i></span>
            <span class="label">New Parts Request</span>
        </a>

        <a href="{{ route('vehicles.new') }}" class="tile tile-teal">
            <span class="icon-circle"><i class="bi bi-truck-front"></i></span>
            <span class="label">New Vehicles Request</span>
        </a>

        <a href="{{ route('parts.manage') }}" class="tile tile-green">
            <span class="icon-circle"><i class="bi bi-check2-circle"></i></span>
            <span class="label">Manage Parts Request</span>
        </a>

        <a href="{{ route('vehicles.manage') }}" class="tile tile-amber">
            <span class="icon-circle"><i class="bi bi-check2-circle"></i></span>
            <span class="label">Manage Vehicles Request</span>
        </a>
    </div>
@endsection