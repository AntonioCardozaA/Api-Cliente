<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistema de Estudiantes')</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <style>
    /* Reset y tipografía */
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Figtree', sans-serif; }
    :root {
        --primary:#2563eb; --secondary:#0f172a; --light:#f8fafc; --gray:#64748b;
        --success:#10b981; --warning:#f59e0b; --danger:#ef4444; --radius:8px;
        --transition: all 0.2s ease;
    }

    body { background: var(--secondary); color: var(--light); min-height: 100vh; line-height:1.5; }

    .app-container { display:flex; min-height:100vh; }

    /* Sidebar */
    .sidebar {
        width:220px; background: var(--secondary); padding:2rem 1rem;
        display:flex; flex-direction:column; position:fixed; height:100vh;
    }
    .logo { display:flex; align-items:center; gap:10px; margin-bottom:2rem; font-weight:700; font-size:1.4rem; color:var(--primary); }
    .nav-menu { flex:1; }
    .nav-item {
        display:flex; align-items:center; gap:10px; padding:0.7rem 1rem;
        border-radius:var(--radius); color:var(--gray); text-decoration:none;
        transition: var(--transition);
    }
    .nav-item:hover, .nav-item.active { background: var(--primary); color: white; }
    .nav-item i { width:20px; text-align:center; }

    .footer-sidebar { padding-top:1.5rem; font-size:0.8rem; color:var(--gray); text-align:center; }

    /* Main Content */
    .main-content { flex:1; margin-left:220px; padding:2rem; }
    .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; }
    .header-title h1 { font-size:1.8rem; font-weight:600; }
    .header-title p { color: var(--gray); font-size:0.9rem; margin-top:0.2rem; }

    .user-profile {
        display:flex; align-items:center; gap:10px; padding:0.5rem 1rem;
        border-radius:var(--radius); background: #1e293b; cursor:pointer; transition: var(--transition);
    }
    .user-profile:hover { background: #273449; }
    .user-avatar { width:36px; height:36px; border-radius:50%; background: var(--primary); display:flex; align-items:center; justify-content:center; font-weight:600; }

    .content-wrapper { background:#1e293b; border-radius:var(--radius); padding:1.5rem; min-height:70vh; }

    /* Buttons */
    .btn { padding:0.6rem 1.2rem; border-radius:var(--radius); border:none; font-weight:500; cursor:pointer; transition: var(--transition); text-decoration:none; }
    .btn-primary { background:var(--primary); color:white; }
    .btn-primary:hover { background: #1d4ed8; }

    .btn-success { background: var(--success); color:white; }
    .btn-danger { background: var(--danger); color:white; }

    /* Tables */
    table { width:100%; border-collapse:collapse; background: #1e293b; border-radius:var(--radius); overflow:hidden; }
    th, td { padding:0.5rem 1rem; text-align:left; border-bottom:1px solid #273449; }
    th { font-weight:600; color:var(--light); }
    tr:hover { background: #2563eb20; }

    /* Alerts */
    .alert-container { position:fixed; top:20px; right:20px; z-index:1000; max-width:350px; }
    .alert { padding:0.8rem 1rem; border-radius:var(--radius); margin-bottom:0.8rem; display:flex; align-items:center; gap:10px; }
    .alert-success { background: var(--success); color:white; }
    .alert-error { background: var(--danger); color:white; }
    .alert-warning { background: var(--warning); color:white; }

    @media (max-width:768px) {
        .sidebar { transform: translateX(-100%); transition: var(--transition); }
        .sidebar.active { transform: translateX(0); }
        .main-content { margin-left:0; }
        .menu-toggle { display:block; background: var(--primary); color:white; border:none; padding:0.6rem; border-radius:var(--radius); font-size:1.1rem; cursor:pointer; }
    }
</style>


    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="logo-text">EduSys</div>
            </div>
            <nav class="nav-menu">
                <a href="{{ route('students.index') }}" class="nav-item {{ request()->routeIs('students.index') ? 'active' : '' }}"><i class="fas fa-users"></i> Estudiantes</a>
                <a href="{{ route('student.create') }}" class="nav-item {{ request()->routeIs('student.create') ? 'active' : '' }}"><i class="fas fa-user-plus"></i> Nuevo Estudiante</a>
            </nav>
            <div class="footer-sidebar">
                <p>© 2025 EduSys v1.0</p>
                <p>Sistema de Gestión Estudiantil</p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <div class="header-title">
                    <h1>@yield('title', 'Dashboard')</h1>
                    <p>@yield('subtitle', 'Gestión de estudiantes')</p>
                </div>
                <div class="header-actions">
                    <button class="menu-toggle" id="menuToggle" style="display:none;"><i class="fas fa-bars"></i></button>
                    <div class="user-profile">
                        <div class="user-avatar"><i class="fas fa-user"></i></div>
                        <div class="user-info"><h4>Administrador</h4><p>admin@edusys.com</p></div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            <div class="alert-container">
                @if(session('success')) <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div> @endif
                @if(session('error')) <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div> @endif
                @if(session('warning')) <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div> @endif
            </div>

            <!-- Content -->
            <div class="content-wrapper">@yield('content')</div>

            <!-- Footer -->
            <footer style="margin-top:2rem; text-align:center; color:var(--gray); font-size:0.9rem;">
                <p>Sistema desarrollado con Laravel • {{ date('Y') }}</p>
            </footer>
        </main>
    </div>
</body>
</html>
