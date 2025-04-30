<!DOCTYPE html>
<html>

<head>
    @include('admin.layouts.header')
    @stack('header')
</head>

<div class="d-flex">

    @include('admin.layouts.sidebar')

    <div class="w-100">
        @include('admin.layouts.navbar')

        @yield('main-content')

    </div>
</div>
@include('admin.layouts.footer')

@include('vendor.layouts.footer_script')

</html>