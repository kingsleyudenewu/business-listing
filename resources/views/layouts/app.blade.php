<!doctype html>
<html lang="en">
@include('includes.head-meta')
<body>
<!-- Begin page -->
<div id="wrapper">
    <!-- Start Side bar -->
@if(!is_null(auth()->user()))
    @include('includes.top-bar')
    @include('includes.sidebar')
@endif
<!--  End Sidebar -->

@if(!is_null(auth()->user()))
    <!-- Start Content -->
        <div class="content-page">
            @yield('content')
            <footer class="footer">&copy; {{ date('Y', time()) }} {{ env('APP_NAME') }} <span
                    class="d-none
        d-sm-inline-block">-
                Crafted
                with <i class="mdi mdi-heart text-danger"></i> by Kingsley Udenewu</span>.
            </footer>
        </div>
        <!-- End Content-->
    @else
        @yield('content')
    @endif


</div>
@include('includes.footer')
@yield('script')
</body>
</html>
