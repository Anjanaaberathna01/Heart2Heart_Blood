<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Heart2Heart LK')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #dc3545;
            --primary-dark: #c82333;
            --secondary-color: #667eea;
            --bg-light: #f8f9fa;
            --text-dark: #333;
            --text-light: #6c757d;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            background-color: #fff;
        }

        /* Navigation Bar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #a71e2a 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: 700;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand .logo-icon {
            font-size: 30px;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(10px, 10px);
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            transition: 0.3s;
            display: block;
        }

        /* Navigation Menu */
        .nav-menu {
            display: flex;
            gap: 30px;
            list-style: none;
            align-items: center;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            min-width: 200px;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
            overflow: hidden;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .dropdown-item:hover {
            background-color: var(--bg-light);
            border-left-color: var(--primary-color);
            padding-left: 25px;
        }

        .dropdown-item i {
            width: 18px;
            color: var(--primary-color);
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-auth {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 2px solid white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-login:hover {
            background: white;
            color: var(--primary-color);
        }

        .btn-register {
            background: white;
            color: var(--primary-color);
            border: 2px solid white;
        }

        .btn-register:hover {
            background: var(--bg-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
        }

        .btn-logout:hover {
            background: rgba(255, 0, 0, 0.8);
            border-color: rgba(255, 0, 0, 0.8);
        }

        /* User Profile Section */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            color: white;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border: 2px solid white;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-role {
            font-size: 12px;
            opacity: 0.9;
        }

        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            min-height: calc(100vh - 70px);
        }

        /* Alerts */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-container {
                padding: 0 15px;
                height: 60px;
            }

            .navbar-brand {
                font-size: 20px;
            }

            .navbar-brand .logo-icon {
                font-size: 24px;
            }

            .menu-toggle {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                left: -100%;
                top: 60px;
                flex-direction: column;
                background: linear-gradient(135deg, var(--primary-color) 0%, #a71e2a 100%);
                width: 100%;
                text-align: center;
                transition: 0.3s;
                gap: 0;
                padding: 20px 0;
                align-items: stretch;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-item {
                width: 100%;
            }

            .nav-link {
                display: flex;
                justify-content: center;
                padding: 15px 20px;
                border-radius: 0;
            }

            .dropdown-menu {
                position: static;
                display: none;
                background: rgba(255, 255, 255, 0.1);
                box-shadow: none;
                margin-top: 0;
                border-radius: 0;
            }

            .dropdown.active .dropdown-menu {
                display: block;
            }

            .dropdown-item {
                justify-content: center;
                padding: 10px 20px;
            }

            .auth-buttons {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                flex-direction: column;
                gap: 10px;
                padding: 15px;
                background: linear-gradient(135deg, var(--primary-color) 0%, #a71e2a 100%);
                z-index: 999;
            }

            .btn-auth {
                width: 100%;
                justify-content: center;
            }

            .main-content {
                padding: 15px;
                min-height: calc(100vh - 60px);
                padding-bottom: 120px;
            }

            .user-profile {
                gap: 10px;
            }

            .user-info {
                display: none;
            }

            .avatar {
                width: 35px;
                height: 35px;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 18px;
                gap: 5px;
            }

            .navbar-brand .logo-icon {
                font-size: 20px;
            }

            .nav-link {
                font-size: 14px;
                gap: 5px;
            }

            .dropdown-item {
                font-size: 13px;
                padding: 10px 15px;
            }

            .btn-auth {
                padding: 10px 15px;
                font-size: 12px;
            }

            .user-name {
                font-size: 13px;
            }

            .user-role {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-brand">
                <span class="logo-icon">❤️</span>
                <span>Heart2Heart LK</span>
            </a>

            <button class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <ul class="nav-menu" id="navMenu">
                @if(auth()->check())
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#blood-request" class="nav-link">
                            <i class="fas fa-droplet"></i>
                            <span>Blood Request</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#history" class="nav-link">
                            <i class="fas fa-history"></i>
                            <span>History</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#hospitals" class="nav-link">
                            <i class="fas fa-hospital"></i>
                            <span>Hospitals</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a href="/profile" class="dropdown-item">
                                <i class="fas fa-user-edit"></i>
                                <span>Update Profile</span>
                            </a>
                            <a href="/profile/settings" class="dropdown-item">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <a href="/profile/donations" class="dropdown-item">
                                <i class="fas fa-heart"></i>
                                <span>My Donations</span>
                            </a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">
                            <i class="fas fa-info-circle"></i>
                            <span>About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">
                            <i class="fas fa-envelope"></i>
                            <span>Contact</span>
                        </a>
                    </li>
                @endif
            </ul>

            <div class="auth-buttons" id="authButtons">
                @if(auth()->check())
                    <div class="user-profile">
                        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">Donor</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-auth btn-logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-auth btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">
                        <i class="fas fa-user-plus"></i>
                        <span>Register</span>
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const navMenu = document.getElementById('navMenu');

        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking on a link
        const navLinks = navMenu.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });

        // Dropdown toggle for mobile
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            const link = dropdown.querySelector('.nav-link');
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    dropdown.classList.toggle('active');
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.navbar')) {
                menuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>
