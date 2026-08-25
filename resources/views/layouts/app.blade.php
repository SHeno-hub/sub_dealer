<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sub-Dealer Portal')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --brand: #1a73c7;
            --brand-dark: #14589c;
            --ink: #22262b;
            --muted: #6b7684;
            --line: #e7eaee;
            --bg: #f4f6f8;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: var(--bg);
            color: var(--ink);
        }

        header {
            position: sticky;
            top: 0;
            z-index: 30;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 14px 24px;
            border-bottom: 1px solid var(--line);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .icon-btn {
            border: none;
            background: transparent;
            font-size: 22px;
            color: var(--ink);
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .15s;
        }

        .icon-btn:hover { background: #f0f2f5; }

        .header-left .title {
            font-weight: 700;
            font-size: 17px;
            letter-spacing: .3px;
        }

        .user-menu { position: relative; }

        .user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
            background: transparent;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 8px;
        }

        .user-trigger:hover { background: #f0f2f5; }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--brand);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-trigger .email {
            font-size: 14px;
            color: var(--ink);
        }

        .user-trigger .chevron {
            font-size: 12px;
            color: var(--muted);
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            box-shadow: 0 12px 30px rgba(20, 30, 45, .12);
            min-width: 190px;
            padding: 6px;
            display: none;
            overflow: hidden;
        }

        .user-dropdown.open { display: block; }

        .user-dropdown .email-full {
            padding: 10px 12px;
            font-size: 13px;
            color: var(--muted);
            border-bottom: 1px solid var(--line);
            margin-bottom: 4px;
            word-break: break-all;
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: none;
            background: transparent;
            color: #c0392b;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            text-align: left;
        }

        .logout-btn:hover { background: #fdecea; }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 32, .35);
            z-index: 40;
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s;
        }

        .sidebar-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 290px;
            background: #fff;
            z-index: 50;
            transform: translateX(-100%);
            transition: transform .25s ease;
            box-shadow: 8px 0 24px rgba(0, 0, 0, .08);
            overflow-y: auto;
        }

        .sidebar.open { transform: translateX(0); }

        .sidebar-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
        }

        .sidebar-head strong { font-size: 16px; }

        .sidebar-section {
            padding: 14px 12px 4px;
        }

        .sidebar-section h4 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--muted);
            margin: 6px 12px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--ink);
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .sidebar-link:hover { background: #f0f5fb; color: var(--brand-dark); }

        .sidebar-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            color: var(--brand);
        }

        .content {
            padding: 28px 28px 60px;
        }

        @media (max-width: 640px) {
            .user-trigger .email { display: none; }
            .content { padding: 20px 16px 40px; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar(false)"></div>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-head">
            <strong>SUB-DEALER PORTAL</strong>
            <button class="icon-btn" onclick="toggleSidebar(false)"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="sidebar-section">
            <h4>Requests</h4>
            <a href="{{ route('parts.new') }}" class="sidebar-link"><i class="bi bi-box-seam"></i> New Parts Request</a>
            <a href="{{ route('vehicles.new') }}" class="sidebar-link"><i class="bi bi-truck-front"></i> New Vehicles Request</a>
            <a href="{{ route('parts.manage') }}" class="sidebar-link"><i class="bi bi-check2-circle"></i> Manage Parts Request</a>
            <a href="{{ route('vehicles.manage') }}" class="sidebar-link"><i class="bi bi-check2-circle"></i> Manage Vehicles Request</a>
        </div>
    </aside>

    <header>
        <div class="header-left">
            <button class="icon-btn" onclick="toggleSidebar(true)"><i class="bi bi-list"></i></button>
            <span class="title">SUB-DEALER PORTAL</span>
        </div>

        <div class="user-menu">
            @php $userEmail = session('temp_user_email') ?? 'Guest'; @endphp
            <button class="user-trigger" onclick="toggleUserMenu()">
                <span class="avatar">{{ strtoupper(substr($userEmail, 0, 1)) }}</span>
                <span class="email">{{ $userEmail }}</span>
                <i class="bi bi-chevron-down chevron"></i>
            </button>

            <div class="user-dropdown" id="userDropdown">
                <div class="email-full">{{ $userEmail }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <script>
        function toggleSidebar(forceOpen) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const shouldOpen = typeof forceOpen === 'boolean' ? forceOpen : !sidebar.classList.contains('open');
            sidebar.classList.toggle('open', shouldOpen);
            overlay.classList.toggle('open', shouldOpen);
        }

        function toggleUserMenu() {
            document.getElementById('userDropdown').classList.toggle('open');
        }

        document.addEventListener('click', function (e) {
            const menu = document.getElementById('userDropdown');
            const trigger = e.target.closest('.user-trigger');
            if (!trigger && !e.target.closest('.user-dropdown')) {
                menu.classList.remove('open');
            }
        });
    </script>
</body>
</html>