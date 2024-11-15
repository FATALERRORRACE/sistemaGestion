<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('index/header')

<body class="antialiased">
    @include('index/navbar')
    @include('index/subnavbar')
    
    <main role="main" class="wrapper">
        <div id="tableContent"></div>
    </main>
    @include('index/js')
</body>
</html>