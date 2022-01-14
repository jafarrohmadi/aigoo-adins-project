<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts._head')

<body>

<div>
    <div class="login-logo">
        <a href="/"><b>Ad Ins</b> Dashboard</a>
    </div>

    @yield('content')
</div>

@livewireScripts

<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>