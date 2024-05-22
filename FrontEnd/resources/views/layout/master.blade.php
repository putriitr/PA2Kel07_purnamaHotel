<!DOCTYPE html>
<html lang="en">
<head>
    @include('partial.head')
    <title>@yield('title')</title>
</head>
<body>
    @include('partial.navbar')
    <div class="container-xxl bg-white p-0">
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">@yield('header-title')</h1>
                </div>
            </div>
        </div>
        <div class="container-xxl py-5">
            <div class="container">
                @yield('content')
            </div>
        </div>
        @include('partial.footer')
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include('partial.js')
</body>
</html>
