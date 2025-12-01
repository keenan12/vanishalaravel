<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vanisha Bakery Admin')</title>
    <style>
        /* ==================== RESET & GLOBAL ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ==================== SCROLLBAR ==================== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }

        /* ==================== CONTAINER ==================== */
        .container-fluid {
            display: flex;
            height: 100vh;
            position: relative;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            color: white;
            padding: 25px 0;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 40px;
            text-align: center;
            border-bottom: 2px solid rgba(102, 126, 234, 0.5);
            padding: 0 15px 20px 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0 10px;
        }

        .sidebar li {
            margin: 8px 0;
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .sidebar a:hover {
            background-color: rgba(102, 126, 234, 0.2);
            color: white;
            transform: translateX(5px);
            padding-left: 20px;
        }

        .sidebar a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            font-weight: 600;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f5f7fa;
            transition: margin-left 0.3s ease;
        }

        /* ==================== TOPBAR ==================== */
        .topbar {
            background: white;
            padding: 18px 30px;
            border-bottom: 1px solid #e8ecf1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 500;
        }

        .topbar-left {
            font-size: 14px;
            color: #666;
        }

        .topbar-right {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        /* ==================== PROFILE DROPDOWN ==================== */
        .profile-dropdown {
            position: relative;
            display: flex;
            align-items: center;
        }

        .profile-btn {
            background: white;
            border: 1px solid #e8ecf1;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px 6px 6px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-family: inherit;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .profile-btn:hover {
            background-color: #f8f9fa;
            border-color: #667eea;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        }

        .profile-avatar-wrapper {
            position: relative;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
        }

        .profile-avatar-wrapper img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-status {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            background: #4ade80;
            border: 2px solid white;
            border-radius: 50%;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            min-width: 120px;
        }

        .profile-name {
            color: #1e293b;
            font-weight: 600;
            font-size: 14px;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        .profile-role {
            font-size: 12px;
            color: #64748b;
            margin-top: 2px;
        }

        .profile-chevron {
            color: #94a3b8;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .profile-btn:hover .profile-chevron {
            transform: translateY(2px);
            color: #667eea;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            min-width: 280px;
            z-index: 1001;
            overflow: hidden;
            animation: dropdownSlide 0.3s ease-out;
        }

        @keyframes dropdownSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-header {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .dropdown-avatar {
            flex-shrink: 0;
        }

        .dropdown-avatar img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
        }

        .dropdown-user-info {
            flex: 1;
            min-width: 0;
        }

        .dropdown-name {
            color: white;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-email {
            color: rgba(255, 255, 255, 0.9);
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-body {
            padding: 8px;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #1e293b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .dropdown-item svg {
            color: #64748b;
            flex-shrink: 0;
            width: 16px;
            height: 16px;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: #667eea;
        }

        .dropdown-item:hover svg {
            color: #667eea;
        }

        .dropdown-footer {
            padding: 8px;
            border-top: 1px solid #f1f5f9;
        }

        .dropdown-logout {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            width: 100%;
            background: none;
            border: none;
            color: #ef4444;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .dropdown-logout svg {
            flex-shrink: 0;
            width: 16px;
            height: 16px;
        }

        .dropdown-logout:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* ==================== CONTENT ==================== */
        .content {
            flex: 1;
            padding: 30px 40px;
            overflow-y: auto;
            max-width: 1450px;
            margin: 0 auto;
            width: 100%;
        }

        .breadcrumb {
            margin-bottom: 25px;
            font-size: 14px;
            color: #666;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        /* ==================== ALERTS/FLASH MESSAGES (NEW) ==================== */
        .alert-container {
            position: fixed;
            top: 80px; /* Jarak dari topbar */
            right: 30px;
            width: 100%;
            max-width: 400px;
            z-index: 1050;
        }
        
        .alert {
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            border-left: 5px solid;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeInOut 0.5s ease-in-out;
            font-size: 14px;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: #ecfdf5;
            border-color: #10b981;
            color: #065f46;
        }
        
        .alert-error {
            background-color: #fef2f2;
            border-color: #ef4444;
            color: #991b1b;
        }
        
        .alert-warning {
            background-color: #fffbeb;
            border-color: #f59e0b;
            color: #92400e;
        }
        
        .alert-close {
            background: none;
            border: none;
            cursor: pointer;
            color: inherit;
            font-size: 18px;
            line-height: 1;
            margin-left: 10px;
            transition: opacity 0.2s;
        }
        
        .alert-close:hover {
            opacity: 0.8;
        }
        
        @keyframes fadeInOut {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ==================== BUTTONS ==================== */
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            white-space: nowrap;
            text-align: center;
            vertical-align: middle;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
            color: white;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* ==================== TABLES ==================== */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 12px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 12px;
        }

        table tbody tr {
            transition: background-color 0.2s ease;
        }

        table tbody tr:hover {
            background-color: #f9f9f9;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ==================== FORMS ==================== */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 11px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ==================== CARDS ==================== */
        .card {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            border-top: 4px solid #667eea;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #2c3e50;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        /* ==================== PAGINATION ==================== */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 6px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .page-item {
            display: inline-block;
        }

        .page-link {
            display: inline-block;
            padding: 6px 10px;
            font-size: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #667eea;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .page-link:hover {
            background-color: #f0f0f0;
            border-color: #667eea;
        }

        .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
            color: white;
            font-weight: 600;
        }

        .page-item.disabled .page-link {
            color: #999;
            cursor: not-allowed;
            opacity: 0.5;
        }

        /* ==================== MENU TOGGLE ==================== */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #333;
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */
        @media (max-width: 1024px) {
            .content {
                padding: 25px 30px;
                max-width: 100%;
            }

            .topbar {
                padding: 16px 25px;
            }

            .sidebar h2 {
                font-size: 18px;
                margin-bottom: 35px;
            }

            .sidebar a {
                font-size: 13px;
                padding: 12px 14px;
            }

            table th,
            table td {
                padding: 10px 8px;
                font-size: 11px;
            }

            .card {
                padding: 20px;
            }

            .card-header {
                font-size: 16px;
                margin-bottom: 15px;
            }

            .profile-info {
                min-width: 100px;
            }

            .profile-name {
                max-width: 120px;
            }
        }

        @media (max-width: 768px) {
            .container-fluid {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: fixed;
                top: 60px;
                left: 0;
                right: 0;
                bottom: auto;
                transform: translateX(-100%);
                z-index: 999;
                border-radius: 0;
                box-shadow: none;
                max-height: calc(100vh - 60px);
                overflow-y: auto;
                padding: 15px 0;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }

            .sidebar h2 {
                font-size: 18px;
                margin-bottom: 20px;
                padding: 0 15px 15px 15px;
            }

            .sidebar ul {
                padding: 0 10px 15px 10px;
            }

            .sidebar a {
                padding: 12px 14px;
                font-size: 13px;
                gap: 10px;
            }

            .main-content {
                margin-left: 0;
                margin-top: 0;
            }

            .topbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                padding: 12px 15px;
                z-index: 998;
                border-bottom: 1px solid #ddd;
                margin-bottom: 0;
            }

            .topbar-right {
                gap: 10px;
            }

            .topbar-left {
                display: none;
            }

            .menu-toggle {
                display: block;
            }

            .content {
                padding: 20px 15px;
                max-width: 100%;
                margin-top: 60px;
            }
            
            .alert-container {
                top: 70px; /* Sesuaikan posisi alert di mobile */
                right: 15px;
                max-width: calc(100% - 30px);
            }

            .breadcrumb {
                font-size: 12px;
                margin-bottom: 15px;
            }

            .card {
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 15px;
            }

            .card-header {
                font-size: 16px;
                margin-bottom: 15px;
                padding-bottom: 10px;
            }

            table {
                font-size: 11px;
            }

            table th,
            table td {
                padding: 8px 6px;
                font-size: 10px;
            }

            .btn {
                padding: 8px 14px;
                font-size: 12px;
            }

            .form-group input,
            .form-group textarea,
            .form-group select {
                font-size: 16px;
                padding: 10px 12px;
            }

            .form-group label {
                font-size: 13px;
            }

            .pagination {
                gap: 4px;
            }

            .page-link {
                padding: 5px 8px;
                font-size: 11px;
            }

            .profile-btn {
                padding: 6px;
                gap: 8px;
            }

            .profile-info {
                display: none;
            }

            .profile-avatar-wrapper {
                width: 36px;
                height: 36px;
            }

            .profile-status {
                width: 10px;
                height: 10px;
            }

            .dropdown-menu {
                min-width: 260px;
                right: -10px;
            }

            .dropdown-header {
                padding: 16px;
            }

            .dropdown-avatar img {
                width: 44px;
                height: 44px;
            }

            .dropdown-item,
            .dropdown-logout {
                padding: 10px 14px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .sidebar h2 {
                font-size: 16px;
                gap: 4px;
            }

            .sidebar a {
                padding: 10px 12px;
                font-size: 12px;
                gap: 8px;
            }

            .topbar {
                padding: 10px 12px;
            }

            .topbar-right {
                gap: 8px;
            }

            .content {
                padding: 15px;
                margin-top: 50px;
            }
            
            .alert-container {
                top: 60px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 11px;
            }

            .card {
                padding: 12px;
                margin-bottom: 12px;
            }

            .card-header {
                font-size: 15px;
                margin-bottom: 12px;
                padding-bottom: 8px;
            }

            table th,
            table td {
                padding: 6px 4px;
                font-size: 9px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .pagination {
                gap: 3px;
            }

            .page-link {
                padding: 4px 6px;
                font-size: 10px;
            }

            .profile-btn {
                padding: 5px;
            }

            .profile-avatar-wrapper {
                width: 32px;
                height: 32px;
            }

            .profile-status {
                width: 9px;
                height: 9px;
            }

            .dropdown-menu {
                min-width: 240px;
            }
        }

        @media print {
            .sidebar,
            .topbar,
            .menu-toggle,
            .alert-container { /* Sembunyikan alert saat print */
                display: none;
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                max-width: 100%;
                padding: 20px;
                margin-top: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <aside class="sidebar" id="sidebar">
            <h2>Vanisha Bakery</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="@if(Route::currentRouteName() == 'admin.dashboard') active @endif">📊 Dashboard</a></li>
                <li><a href="{{ route('admin.products.index') }}" class="@if(str_contains(Route::currentRouteName(), 'products')) active @endif">📦 Produk</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="@if(str_contains(Route::currentRouteName(), 'categories')) active @endif">🏷️ Kategori</a></li>
                <li><a href="{{ route('admin.stocks.index') }}" class="@if(str_contains(Route::currentRouteName(), 'stocks')) active @endif">📈 Stock</a></li>
                <li><a href="{{ route('admin.sales.index') }}" class="@if(str_contains(Route::currentRouteName(), 'sales')) active @endif">💳 Penjualan</a></li>
                <li><a href="{{ route('admin.reports.index') }}" class="@if(str_contains(Route::currentRouteName(), 'reports')) active @endif">📋 Laporan</a></li>
            </ul>
            {{-- ⭐ TAMBAHKAN BAGIAN INI --}}
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="@if(str_contains(Route::currentRouteName(), 'users')) active @endif">👥 Kelola Admin</a>
            @endif
        </aside>

        <div class="main-content">
            <div class="topbar">
                <div class="topbar-left">@yield('breadcrumb')</div>
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="topbar-right">
                    <div class="profile-dropdown">
                        <button class="profile-btn" id="profileBtn">
                            <div class="profile-avatar-wrapper">
                                <img src="{{ Auth::user()->getAvatarUrl() ?? 'path/to/default/avatar.png' }}" alt="{{ Auth::user()->name }}"> 
                                <div class="profile-status"></div>
                            </div>
                            <div class="profile-info">
                                <div class="profile-name">{{ Auth::user()->name }}</div>
                                <div class="profile-role">Administrator</div>
                            </div>
                            <svg class="profile-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        
                        <div class="dropdown-menu" id="dropdownMenu">
                            <div class="dropdown-header">
                                <div class="dropdown-avatar">
                                    <img src="{{ Auth::user()->getAvatarUrl() ?? 'path/to/default/avatar.png' }}" alt="{{ Auth::user()->name }}">
                                </div>
                                <div class="dropdown-user-info">
                                    <div class="dropdown-name">{{ Auth::user()->name }}</div>
                                    <div class="dropdown-email">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            
                            <div class="dropdown-body">
                                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 8C9.933 8 11.5 6.433 11.5 4.5C11.5 2.567 9.933 1 8 1C6.067 1 4.5 2.567 4.5 4.5C4.5 6.433 6.067 8 8 8Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13.75 15C13.75 12.1005 11.3137 9.75 8 9.75C4.6863 9.75 2.25 12.1005 2.25 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Edit Profil</span>
                                </a>
                                
                                <a href="#" class="dropdown-item" onclick="alert('Fitur segera hadir!'); return false;">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 10.5C9.38071 10.5 10.5 9.38071 10.5 8C10.5 6.61929 9.38071 5.5 8 5.5C6.61929 5.5 5.5 6.61929 5.5 8C5.5 9.38071 6.61929 10.5 8 10.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13 10.5V8.5L14.5 7L13 5.5V3.5L11 2.5L9 1L7 2.5L5 3.5L3 5.5L1.5 7L3 8.5V10.5L5 11.5L7 13L9 14.5L11 13L13 10.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Pengaturan</span>
                                </a>
                            </div>
                            
                            <div class="dropdown-footer">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-logout">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 14H3.5C3.10218 14 2.72064 13.842 2.43934 13.5607C2.15804 13.2794 2 12.8978 2 12.5V3.5C2 3.10218 2.15804 2.72064 2.43934 2.43934C2.72064 2.15804 3.10218 2 3.5 2H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11 11L14 8L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14 8H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="alert-container" id="alertContainer">
                @if (session('success'))
                    <div class="alert alert-success">
                        <span>{{ session('success') }}</span>
                        <button class="alert-close" onclick="this.closest('.alert').style.display='none'">
                            &times;
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error">
                        <span>{{ session('error') }}</span>
                        <button class="alert-close" onclick="this.closest('.alert').style.display='none'">
                            &times;
                        </button>
                    </div>
                @endif
                
                @if (session('warning'))
                    <div class="alert alert-warning">
                        <span>{{ session('warning') }}</span>
                        <button class="alert-close" onclick="this.closest('.alert').style.display='none'">
                            &times;
                        </button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        <span>⚠️ **Terjadi Kesalahan!** Mohon periksa kembali input Anda.</span>
                        <button class="alert-close" onclick="this.closest('.alert').style.display='none'">
                            &times;
                        </button>
                    </div>
                @endif
            </div>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const profileBtn = document.getElementById('profileBtn');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const alertContainer = document.getElementById('alertContainer'); // NEW

            // Toggle sidebar
            if (menuToggle) {
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    sidebar.classList.toggle('active');
                });
            }

            // Profile dropdown
            if (profileBtn && dropdownMenu) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Menggunakan toggle class lebih baik daripada display style
                    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                });

                document.addEventListener('click', function(e) {
                    if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.style.display = 'none';
                    }
                });
            }

            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('active');
                    }
                });
            });

            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickInsideToggle = menuToggle && menuToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickInsideToggle && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    if (dropdownMenu) {
                        dropdownMenu.style.display = 'none';
                    }
                }
            });

            if (alertContainer) {
                const alerts = alertContainer.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.style.opacity = '0';
                        setTimeout(() => {
                            alert.remove();
                        }, 500);
                    }, 5000); 
                });
            }
        });
    </script>
</body>
</html>