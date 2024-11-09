<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('/member/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/member/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/member/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('/member/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('/member/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/member/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/member/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('/member/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('/member/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('/member/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('/member/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed"
        href="{{ asset('/member/images/ico/apple-touch-icon-57-precomposed.png') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/rate/css/rate.css') }}">
</head><!--/head-->

<body>
    @include('member/layout.header')

    @yield('slider')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        @yield('left')
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </section>

    @include('member/layout.footer')

    <script src="{{ asset('/member/js/jquery.js') }}"></script>
    <script src="{{ asset('/member/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/member/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('/member/js/price-range.js') }}"></script>
    <script src="{{ asset('/member/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('/member/js/main.js') }}"></script>
    <script>
        if (screen.width <= 736) {
            document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
    <script src="{{ asset('/rate/js/jquery-1.9.1.min.js') }}"></script>
    @yield('js')
</body>

</html>