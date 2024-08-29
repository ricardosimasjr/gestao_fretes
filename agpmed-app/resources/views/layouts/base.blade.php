<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title') - Gestão de Fretes - AGPMED</title>
</head>

<body>
    <header>
        <div class="conteiner-fluid">
            @include('layouts/nav')
        </div>
    </header>
    <div class="container mt-5">
        <div class="row">
            @yield('content')
        </div>
    </div>

</body>

</html>
