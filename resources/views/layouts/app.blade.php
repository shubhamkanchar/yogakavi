<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ config('app.name', 'Yogkaavi') }} - Transform Your Body, Calm Your Mind. Join us for personalized diet plans and energizing yoga sessions designed specifically for your lifestyle.">
    <meta name="keywords" content="yoga, diet, fitness, health, wellness, meditation, nutrition, diet consultation">
    <meta name="author" content="{{ config('app.name', 'Yogkaavi') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>{{ config('app.name', 'Yogkaavi') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    @yield('style')

    <style>
        .error{
            color: red;
        }
        body,h3,h4,h2,h5,p,a,button,div,span,input,td,th,tr,select,option {
            font-family: 'Inter', sans-serif !important;
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">
    @include('layouts.partials.navbar')
    @include('partials.alerts')
    {{-- <main class="py-4"> --}}
        @yield('content')
    {{-- </main> --}}
    @include('layouts.partials.footer')
    <script type="module" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
</body>
</html>
