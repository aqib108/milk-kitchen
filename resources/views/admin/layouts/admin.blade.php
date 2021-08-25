<!doctype html>
<html lang="en">
    <head>
        @php
        $basepath = url('/');
        $basepath = substr($basepath, -1, 1) == '/' ? $basepath : $basepath . '/';
        @endphp
        <meta name="baseurl" content="{{ $basepath }}" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf_token" id="csrf-token" content="{{ csrf_token() }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin |&nbsp;@yield('title','Dashboard')</title>
        <link rel="shortcut icon" type="image/png" href="{{asset('admin-panel/images/favicon.png')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet"
            href="{{asset('admin-panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/jqvmap/jqvmap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/css/custom.css')}}">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
        <!-- <link rel="stylesheet" href="{{asset('admin-panel/css/dark.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/css/light.css')}}"> -->
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('admin-panel/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/summernote/summernote-bs4.css')}}">

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Admin CSS -->
       

<!-- <link class="js-stylesheet" href="{{ asset('admin-panel/css/custom.css') }}" rel="stylesheet"> -->
<!-- <link class="js-stylesheet" href="{{ asset('admin-panel/css/sweetalert.css') }}" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.0/css/dataTables.dateTime.min.css">
        <!-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/other.css') }}" rel="stylesheet" /> -->
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <!-- Toggel button!-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
            rel="stylesheet">

        @yield('styles')
        <style>
            .hidden {
                display: none;
            }
            .mediaCenterButton {
                text-align: right;
            }
            .image-size {
                width: 240px;
                height: 120px;
            }
            .images-size {
                width: 70px;
                height: 70px;
            }
            .img_loop {
                float: left;
                width: 20%;
                position: relative;
                padding: 5px;
            }
            .img_loop span {
                background: #e2e1e1;
                padding: 2px;
                border-radius: 50px;
                width: 15px;
                display: block;
                text-align: center;
                height: 15px;
                line-height: 11px;
                position: absolute;
                right: 0;
                top: -3px;
                color: #bf0f0f;
                cursor: pointer;
            }
            .img_loop img {
                height: 70px;
                object-fit: cover;
            }
            .custom-image-upload {
                padding: 3px;
                background-color: aliceblue;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
                @include('admin.layouts.include.navbar')
            <!-- /.navbar -->

            <!-- /.SIDEBAR -->
                @include('admin.layouts.include.sidebar')
            <!-- /.SIDEBAR END -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.CONTENT-WRAPPER END -->

            <!-- /.FOOTER -->
                @include('admin.layouts.include.footer')
            <!-- /.FOOTER END -->

            <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- SCRIPTS START -->
            @include('admin.layouts.include.scripts')
        <!-- END SCRIPT -->

        @include('admin.layouts.include._notifications')
   
@yield('scripts')    
</body>
</html>