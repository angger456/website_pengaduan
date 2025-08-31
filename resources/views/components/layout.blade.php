<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Dinsos</title>

    {{-- Header Admin Component --}}
    <x-header_admin />
</head>
<body id="page-top">

    {{-- Sidebar --}}
    <x-sidebar_admin />

    {{-- Topbar --}}
    <x-topbar_admin />

    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{ $slot }}
    </div>
    <!-- /.container-fluid -->

    {{-- Footer --}}
    <x-footer_admin />

</body>
</html>
