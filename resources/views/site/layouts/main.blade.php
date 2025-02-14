<!DOCTYPE html>
<html lang="en">

<head>
    @include('site.layouts.header')
</head>

<body>
    @include('site.layouts.navbar')

    @yield('main-section')

    @include('site.layouts.footer')

</body>

</html>