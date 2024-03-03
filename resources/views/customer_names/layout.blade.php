<!DOCTYPE html>
<html>
<head>
    <title>Customer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.15.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../5848543.jpg');
            background-repeat: no-repeat;
            background-size:  100% 100%;
            background-attachment: fixed;
        }
        .container {
            max-width: 1520px;
            margin: 60px auto;
            background-color: rgba(255, 255, 255, 0.348);
            color: black;
        }

        .top-navbar {
            background-color: #333;
            color: white;
            padding: 18px 0;
            width: 100%;
            z-index: 2;
            position: fixed;
            top: 0;
            left: 0;
        }
        
        .required{
            color: #ff3030
        }

        .top-navbar .navbar-brand {
            font-size: 24px;
            margin: 0 20px;
        }

        .sidenav {
            height: calc(100% - 55px);
            width: 175px;
            position: fixed;
            z-index: 1;
            top: 57px;
            left: -250px;
            background-color: #afadad;
            padding-top: 20px;
            transition: 0.5s;
            overflow-x: hidden;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: #fdfdfd;
            display: block;
        }

        .sidenav a:hover {
            color: #4d0101;
        }

        .open-btn {
            font-size: 24px;
            cursor: pointer;
            color: white;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 2;
        }

        .sidenav.open {
            left: 0;
        }

        .pagination > .active > span {
            z-index: 0;
        }

        @media screen and (max-width: 768px) {
            .sidenav {
                left: -250px;
            }

            .open-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
    <nav class="top-navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <span class="open-btn" onclick="toggleNav()">&#9776;</span>
        
        <div class="navbar-brand" style="text-align: center; display: flex; justify-content: center; align-items: center;">
            <i class="fas fa-layer-minus"></i>
        </div>

        @auth
        <div class="user-menu" style="padding-left: 90%">
            <div class="user-menu-content" id="userMenu">
                <strong><a href="{{ route('logout') }}" style="color: #f50707"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        @endauth
    </nav>

    <div class="sidenav" id="sidebar" onmouseleave="closeNav()">
        @if (auth()->check())
            @php
                $userRoles = DB::table('model_has_roles')
                    ->where('model_id', auth()->user()->id)
                    ->pluck('role_id');
    
                $adminRoleId = 1;
    
                $isAdmin = in_array($adminRoleId, $userRoles->toArray());
            @endphp
    
            @if ($isAdmin)
                <a href="{{ route('customer_names.index') }}"><i class="fas fa-users"></i> Customers</a>
                <a href="{{ route('tickets.index') }}"><i class="fas fa-ticket-alt"></i> Tickets</a>
                <a href="{{ route('user.index') }}"><i class="fas fa-user"></i> Add user</a>
                <a href="{{ route('usertickets.index') }}"><i class="fas fa-ticket-alt"></i> User Ticket</a>
                <a href="{{ route('roles.index') }}"><i class="fas fa-user-lock"></i> Role</a>
            @else
                <a href="{{ route('usertickets.index') }}"><i class="fas fa-ticket-alt"></i> User Ticket</a>
            @endif
        @endif
    </div>
        
    {{-- <div class="sidenav" id="sidebar" onmouseleave="closeNav()">
        @if (auth()->check())
            @if (auth()->user()->isAdmin())
                <a href="{{ route('customer_names.index') }}"><i class="fas fa-users"></i> Customers</a>
                <a href="{{ route('tickets.index') }}"><i class="fas fa-ticket-alt"></i> Tickets</a>
                <a href="{{ route('usertickets.index') }}"><i class="fas fa-ticket-alt"></i> User Ticket</a>
                <a href="{{ route('user.index') }}"><i class="fas fa-user"></i> Add user</a>
                <a href="{{ route('roles.index') }}"><i class="fas fa-user-lock"></i> Role</a>
            @else
                <a href="{{ route('usertickets.index') }}"><i class="fas fa-ticket-alt"></i> User Ticket</a>
            @endif
        @endif
    </div>
     --}}
    

    <div class="container">
        <div class="content" style="margin-top: 60px;">
            @yield('content')
        </div>
    </div>

    <script>
        function toggleNav() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("open");
        }

        function closeNav() {
            var sidebar = document.getElementById("sidebar");
            sidebar.classList.remove("open");
        }
    </script>
</body>
</html>
