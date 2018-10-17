<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | {{ Config::get('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/font-awesome-4.5.0.min.css') }}">
    @yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include("admin.header")
        @include("admin.menu")
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    @yield('content_title')
                    <small>@yield('content_title_small')</small>
                </h1>
            </section>
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include("admin.footer")
    </div>
    <!-- ./wrapper -->

    <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/app.min.js') }}"></script>
    <script src="{{ asset('/js/common.js') }}"></script>
@yield('js')
</body>
</html>
