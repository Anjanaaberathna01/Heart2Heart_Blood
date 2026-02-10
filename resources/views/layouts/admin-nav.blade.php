<style>
    /* Font Awesome Import */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    /* Navbar Styles */
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
        transition: all 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .logo-icon {
        font-size: 28px;
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

    .nav-item.mobile-only {
        display: none;
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

    /* Dropdown Menu */
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

    .dropdown-item i {
        font-size: 14px;
    }

    /* Auth Buttons */
    .auth-buttons {
        display: flex;
        align-items: center;
        gap: 20px;
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
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 16px;
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
        display: flex;
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
    }

    .btn-auth:hover {
        background: rgba(255, 255, 255, 0.3);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* Mobile Responsive */
    @media (max-width: 1200px) {
        .navbar-container {
            padding: 0 15px;
        }

        .nav-link {
            padding: 8px 12px;
            font-size: 13px;
        }

        .dropdown-menu {
            min-width: 180px;
        }
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

        .nav-item.mobile-only {
            display: flex;
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
            max-height: 300px;
        }

        .dropdown-item {
            padding: 12px 20px 12px 40px;
        }

        .dropdown-item:hover {
            padding-left: 40px;
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

        .navbar-brand {
            font-size: 18px;
            gap: 8px;
        }

        .logo-icon {
            font-size: 24px;
        }

        .nav-menu {
            top: 60px;
        }

        .dropdown-item {
            font-size: 13px;
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

<!-- Admin Navigation Bar -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            <span class="logo-icon">🩸</span>
            <span>Heart2Heart Admin</span>
        </a>

        <button class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="nav-menu" id="navMenu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.hospitals') }}" class="nav-link">
                    <i class="fas fa-hospital"></i>
                    <span>Hospitals</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link">
                    <i class="fas fa-droplet"></i>
                    <span>Requests</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('admin.donate.all') }}" class="dropdown-item">
                        <i class="fas fa-list"></i>
                        <span>All Requests</span>
                    </a>
                    <a href="{{ route('admin.donate.pending') }}" class="dropdown-item">
                        <i class="fas fa-hourglass-half"></i>
                        <span>Pending</span>
                    </a>
                    <a href="{{ route('admin.donate.approved') }}" class="dropdown-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Approved</span>
                    </a>
                    <a href="{{ route('admin.donate.rejected') }}" class="dropdown-item">
                        <i class="fas fa-times-circle"></i>
                        <span>Rejected</span>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.add.hospital') }}" class="nav-link">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Hospital</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Articles</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu">
                <a href="{{ route("admin.articles") }}" class="dropdown-item">
                    <i class="fas fa-eye"></i>
                    <span>Pending Articles</span>
                </a>
                <a href="{{ route('admin.articles.approved') }}" class="dropdown-item">
                    <i class="fas fa-check"></i>
                    <span>Approved Articles</span>
                </a>
                <a href="{{ route('admin.articles.rejected') }}" class="dropdown-item">
                    <i class="fas fa-times"></i>
                    <span>Rejected Articles</span>
                </a>
            </div>
            </li>
            <li class="nav-item mobile-only">
                <a href="{{ route('admin.logout') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>

        <div class="auth-buttons" id="authButtons">
            <div class="user-profile">
                <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="user-role">Administrator</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-auth btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
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
                if (window.innerWidth <= 992) {
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
