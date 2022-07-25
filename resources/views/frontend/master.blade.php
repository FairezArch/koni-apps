@include('frontend.components.header')
@include('frontend.components.menus')
<div class="main bg-white text-dark" style="position: relative; min-height: 100vh">
    @yield('content')
</div>
@include('frontend.components.footer')
