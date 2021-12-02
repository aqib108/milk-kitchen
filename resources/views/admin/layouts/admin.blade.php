<!doctype html>
<html lang="en">
    <head>
        @php
            $basepath = url('/');
            $basepath = substr($basepath, -1, 1) == '/' ? $basepath : $basepath . '/';
        @endphp
        <meta name="baseurl" content="{{ $basepath }}" />
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf_token" id="csrf-token" content="{{ csrf_token() }}" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin |&nbsp;@yield('title','Dashboard')</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('admin-panel/images/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin-panel/favicon_io/favicon-32x32.png') }}">

        <link rel="shortcut icon" href="{{ asset('admin-panel/favicon_io/favicon.ico') }}" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet"
            href="{{ asset('admin-panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/jqvmap/jqvmap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin-panel/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/daterangepicker/daterangepicker.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/summernote/summernote-bs4.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- SweetAlert2 -->
        <link rel="stylesheet"
            href="{{ asset('admin-panel/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('admin-panel/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet"
            href="{{ asset('admin-panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        <!-- Admin CSS -->
        <link rel="stylesheet" href="{{ asset('admin-panel/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-panel/css/sweetalert.css') }}">
        <!-- Toggel button!-->
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
            rel="stylesheet">
        @yield('styles')
        <style>
            body {
                font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

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
            
            .notification-heart {
                
                animation: 1s infinite beatHeart;
            }
            @keyframes beatHeart {
                0% {
                    transform: scale(1);
                    color: #9a9da0
                }

                25% {
                    transform: scale(1.5);
                    color:#fff
                }

                40% {
                    transform: scale(1);
                    color: #9a9da0
                }

                60% {
                    transform: scale(1.5);
                    color : #fff
                }

                100% {
                    transform: scale(1);
                    color :#9a9da0
                }
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <!-- <script>
            $(document).ready(function(){
                $(document).on('input',function() {
                    $('.price').mask("###0.00", {reverse: true});
                    $('.driver').mask("0000", {reverse: true});
                });
            });
        </script> -->
        <script>
            var notID = 0;
            // setInterval(function() {
            //     $.ajax({
            //         type: "get",
            //         url: '{{ route('checkDriverNotification') }}',
            //         data: {
            //             _token: $('meta[name="csrf-token"]').attr('content')
            //         },
            //         success: function(response) {
            //             if (response !=null) {
            //                 if (response.notifications.length > notID) {
            //                     $('#messageDropdown svg').addClass('notification-heart');
            //                     $('#notificationCount').addClass('notification-heart');
            //                     notID = response.notifications.length;
            //                     $('#notificationCount').empty();
            //                     $('#notificationCount').append(response.notifications.length);
            //                     $('#notifications').empty();
            //                     response.notifications.forEach(function(driverNotification, index) {
            //                        console.log();
            //                         $('#notifications').append('<a href="'+driverNotification.url+'" class="dropdown-item" style="white-space: revert !important;"><i class="fas fa-envelope mr-2"></i>'+ driverNotification.driverMessage +'</a><div class="dropdown-divider"></div>');
            //                     });
            //                     playSound();
            //                 } else {
            //                     $('#messageDropdown svg').removeClass('notification-heart');
            //                     $('#notificationCount').removeClass('notification-heart');
            //                 }
            //             } else {
                            
            //             }
            //         }
            //     });
            // }, 2000);
            function playSound() {
                var audio = new Audio("{{asset('audio/notify.mp3') }}");
                audio.play();
            }
        </script>
    </body>
</html>
