
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    @include('admin.layouts.header')
    @stack('header')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('admin.layouts.sidebar')


            <div class="layout-page">

                @include('admin.layouts.navbar')

                <div class="content-wrapper">

                    @yield('main-content')

                    @include('admin.layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @include('admin.layouts.footer_script')
</body>

</html>