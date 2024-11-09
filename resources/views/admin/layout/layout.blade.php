<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/admin/assets/images/favicon.png') }}">
    <title>Nice admin Template - The Ultimate Multipurpose admin template</title>
    <link href="{{ asset('/admin/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
        @include('admin/layout.header')
        @include('admin/layout.left')
        <div class="page-wrapper">
            @yield('content')
            @include('admin/layout.footer')
        </div>
    </div>
    <script src="{{ asset('/admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('/admin/dist/js/waves.js') }}"></script>
    <script src="{{ asset('/admin/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('/admin/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script
        src="{{ asset('/admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('/admin/dist/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('demo', {
            filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
            filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
        });
    </script>
</body>

</html>