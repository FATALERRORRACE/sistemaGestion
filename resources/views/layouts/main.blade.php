<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components/header')
<body class="antialiased">
    @include('components/navbar')
    @include('components/subnavbar')
    <main role="main" class="wrapper">
        {{ $slot }}
    </main>
    @include('components/js')
</body>
</html>