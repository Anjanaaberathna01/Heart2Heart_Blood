<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    .navbar {
        width: 100%;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        padding: 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
        gap: 12px;
        font-size: 22px;
        font-weight: 700;
        color: white;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.03);
    }

    .logo-icon {
        font-size: 26px;
    }

    .menu-toggle {
        display: none;
        flex-direction: column;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        gap: 6px;
    }

    .menu-toggle span {
        width: 25px;
        height: 3px;
        background-color: white;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    .menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(8px, 8px);
    }

    .menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    .nav-menu {
        display: flex;
        list-style: none;
        gap: 0;
        align-items: center;
        margin: 0;
        padding: 0;
    }

    .nav-item {
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        text-decoration: none;
        padding: 10px 16px;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
    }

    .nav-link i {
        font-size: 16px;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        padding: 8px 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        margin-top: 10px;
        z-index: 10;
    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #333;
        text-decoration: none;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: #f5f5f5;
        color: #dc3545;
        padding-left: 24px;
    }

    .auth-buttons {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 12px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
    }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 14px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .user-name {
        color: white;
        font-weight: 600;
        font-size: 13px;
    }

    .user-role {
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
    }

    .btn-auth {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        font-size: 13px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-auth:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
    }

    @media (max-width: 992px) {
        .menu-toggle {
            display: flex;
        }

        .nav-menu {
            position: absolute;
            top: 70px;
            left: 0;
            width: 100%;
            flex-direction: column;
            background: #c82333;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            gap: 0;
        }

        .nav-menu.active {
            max-height: 500px;
        }

        .nav-item {
            width: 100%;
            height: auto;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link {
            width: 100%;
            padding: 15px 20px;
            border-radius: 0;
        }

        .dropdown-menu {
            position: static;
            max-height: 0;
            overflow: hidden;
            opacity: 1;
            visibility: visible;
            transform: none;
            background: #b81a2c;
            box-shadow: none;
            border-radius: 0;
            transition: max-height 0.3s ease;
            margin-top: 0;
        }

        .dropdown.active .dropdown-menu {
            max-height: 240px;
        }

        .dropdown-item {
            padding: 12px 20px 12px 40px;
            color: #fff;
        }

        .dropdown-item:hover {
            padding-left: 40px;
            color: #ffe4e6;
            background: #b81a2c;
        }

        .auth-buttons {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .navbar-container {
            padding: 0 12px;
            height: 60px;
        }

        .nav-menu {
            top: 60px;
        }

        .navbar-brand {
            font-size: 18px;
        }
    }

    @media (max-width: 480px) {
        .navbar-brand {
            font-size: 16px;
        }

        .nav-link {
            font-size: 12px;
            padding: 12px 16px;
        }

        .user-name {
            display: none;
        }
    }
</style>

<!-- User Navigation Bar -->
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
                    <a href="/dashboard" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/donate-request" class="nav-link">
                        <i class="fas fa-droplet"></i>
                        <span>Blood Request</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/history" class="nav-link">
                        <i class="fas fa-history"></i>
                        <span>History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/hospitals-map" class="nav-link">
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
                        <a href="/profile#change-password" class="dropdown-item">
                            <i class="fas fa-key"></i>
                            <span>Change Password</span>
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

<script>
    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (menuToggle && navMenu) {
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
    }
</script>
