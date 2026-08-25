<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sub-Dealer Portal')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; }
        header {
            display: flex; align-items: center; justify-content: space-between;
            background: #fff; padding: 15px 25px; border-bottom: 1px solid #ddd;
        }
        header .title { font-weight: bold; font-size: 18px; }
        .content { padding: 25px; }
    </style>
</head>
<body>
    <header>
        <div class="title">☰ SUB-DEALER PORTAL</div>
        <div>{{ session('temp_user_email') ?? 'Guest' }}</div>
    </header>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>