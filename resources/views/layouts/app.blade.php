<!DOCTYPE html>
<html lang="en">

@include('includes.header')

<body>
    <!-- Topbar Start -->
    @include('includes.topbar')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('includes.navbar')
    <!-- Navbar End -->

    <!-- Content -->
    @yield('content')
    <!-- Content End -->

    <!-- Footer -->
    @include('includes.footer')
    <!-- Footer End -->
</body>

</html>