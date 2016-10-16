<head>
    <title>@yield('htmlheader_title', 'Your title here')</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="This is a template" />
    <!-- //for-mobile-apps -->
    <link href="{{ asset('css/bootstrap.css', Request::secure()) }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/style.css', Request::secure()) }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/contactstyle.css', Request::secure()) }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/faqstyle.css', Request::secure()) }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('css/single.css', Request::secure()) }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('css/medile.css', Request::secure()) }}" rel='stylesheet' type='text/css' />
    <!-- banner-slider -->
    <link href="{{ asset('css/jquery.slidey.min.css', Request::secure()) }}" rel="stylesheet">
    <!-- pop-up -->
    <link href="{{ asset('css/popuo-box.css', Request::secure()) }}" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="{{ asset('css/font-awesome.min.css', Request::secure()) }}"  rel="stylesheet"/>
    <!-- banner-bottom-plugin -->
    <link href="{{ asset('css/owl.carousel.css', Request::secure()) }}" rel="stylesheet" type="text/css" media="all">

    @yield('page_plugin_css')

    @yield('page_style')
</head>