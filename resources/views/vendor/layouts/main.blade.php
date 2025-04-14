<!DOCTYPE html>
<html>

<head>
    @include('vendor.layouts.header')
    @stack('header')
</head>

<div class="d-flex">

    @include('vendor.layouts.sidebar')

    <div class="w-100">
        @include('vendor.layouts.navbar')

        @yield('main-content')

    </div>
</div>
@include('vendor.layouts.footer_script')

</html>