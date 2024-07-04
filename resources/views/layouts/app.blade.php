<!DOCTYPE html>
<html>
<head>
    @include('includes.style')
</head>
<body>
    @include('components.nav')
    <div class="container mt-5">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
