<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://raw.githubusercontent.com/SantriKoding-com/assets-food-store/refs/heads/main/images/logo.png" type="image/x-icon">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Food Store">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta content="@yield('title')" property="og:title">
    <meta content="@yield('description')" property="og:description">
    <meta content="@yield('image')" property="og:image">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @livewireStyles
    @vite(['resources/css/app.css'])
</head>
<body>

    <!-- render content -->
    {{ $slot }}
    <!-- end render content -->

    <!-- bottom menu -->
    <x-menus.bottom />
    <!-- end bottom menu -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @livewireScripts
    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 
        @elseif(session()->has('info'))
            toastr.info('{{ session('info') }}', 'INFO!');
        @elseif(session()->has('warning'))
            toastr.warning('{{ session('warning') }}', 'PERINGATAN!');
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script>
</body>
</html>