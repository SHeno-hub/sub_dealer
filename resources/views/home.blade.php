@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h2>Welcome</h2>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 20px;">
        <a href="#" style="text-decoration: none; color: #333; text-align: center;">📦<br>New Parts Request</a>
        <a href="#" style="text-decoration: none; color: #333; text-align: center;">🚗<br>New Vehicles Request</a>
        <a href="{{ route('parts.manage') }}" style="text-decoration: none; color: #333; text-align: center;">✅<br>Manage Parts Request</a>
        <a href="{{ route('vehicles.manage') }}" style="text-decoration: none; color: #333; text-align: center;">✅<br>Manage Vehicles Request</a>
    </div>
@endsection