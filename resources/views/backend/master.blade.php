<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    @include('backend.partial.meta')

    @include('backend.partial.style')

</head>
<body>


<div id="layout-wrapper">

    @include('backend.partial.header')

    @include('backend.partial.sidebar')

    @yield('main_content')

</div>

    @include('backend.partial.footer')

    @include('backend.partial.script')
</body>

</html>
