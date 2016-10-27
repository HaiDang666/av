<head>
    <title>@yield('htmlheader_title', 'Your title here')</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="This is a template" />
    <!-- //for-mobile-apps -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/contactstyle.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/faqstyle.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/single.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/medile.css') }}" rel='stylesheet' type='text/css' />
    <!-- banner-slider -->
    <link href="{{ asset('css/jquery.slidey.min.css') }}" rel="stylesheet">
    <!-- pop-up -->
    <link href="{{ asset('css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}"  rel="stylesheet"/>
    <!-- banner-bottom-plugin -->
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet" type="text/css" media="all">

    @yield('page_plugin_css')

    @yield('page_style')

    <style>
        .img-thumbnail-size{
            height: 238px !important;
            width: 175px !important;
        }
    </style>
</head>