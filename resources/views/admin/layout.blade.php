<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – Navbar + Collapsible Sidebar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            overflow-x: hidden;
        }
        body,h3,h4,h2,h5,p,a,button,div,span,input,td,th,tr,select,option {
            font-family: 'Inter', sans-serif;
        }
        
        /* Sidebar */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #343a40;
            transition: all 0.3s ease;
            position: fixed;
            top: 44px; /* height of navbar */
            left: 0;
            padding-top: 20px;
            z-index: 10;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            text-decoration: none;
            white-space: nowrap;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .sidebar .active {
            background: #0d6efd;
        }

        .sidebar .text {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .text {
            opacity: 0;
            visibility: hidden;
        }

        /* Content */
        .content {
            margin-left: 60px;
            margin-top: 60px;
            transition: margin-left 0.3s ease;
            padding: 25px;
        }

        .content.full {
            margin-left: 60px;
        }
    </style>
    @yield('style')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
@include('admin.partials.navbar')
@include('admin.partials.sidebar')
<div id="content" class="content full">
    @yield('content')
</div>
@yield('script')

<script>
    document.getElementById("toggleSidebar").addEventListener("click", function () {
        let sidebar = document.getElementById("sidebar");
        let content = document.getElementById("content");

        sidebar.classList.toggle("collapsed");
        content.classList.toggle("full");
    });
</script>

</body>
</html>
