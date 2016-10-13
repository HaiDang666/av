<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
author: W3layouts
author URL: http://w3layouts.com
-->
<html lang="en">

@section('htmlheader')
    @include('frontend.partials.htmlheader')
@show

<body>
    @include('frontend.partials.mainheader')

    @include('frontend.partials.loginpopup')

    @include('frontend.partials.navigationbar')

    @include('frontend.partials.socialicon')

    @yield('main-content')

    @include('frontend.partials.footer')

    @section('scripts')
        @include('layouts.partials.scripts')
    @show

    @yield('page_plugin_js')

    @yield('page_script')

</body>
</html>