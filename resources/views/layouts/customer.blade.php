<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ************************************************************************ !-->
    <!-- ****                                                              **** !-->
    <!-- ****       ¤ Designed and Developed by  LEADconcept               **** !-->
    <!-- ****               http://www.leadconcept.com                     **** !-->
    <!-- ****                                                              **** !-->
    <!-- ************************************************************************ !-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
    <title>Milk Kitchen</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin-panel/images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin-panel/favicon_io/favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('customer-panel/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer-panel/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer-panel/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
</head>

<body>
    <section>
        @include('include.header')
        <section>
            @yield('content')
        </section>
        @include('include.footer')
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('customer-panel/js/bootstrap.js') }}"></script>
    <script src="{{ asset('customer-panel/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customer-panel/js/index.js') }}"></script>
    <script src="{{ asset('customer-panel/js/fontawesome.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('customer-panel/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('customer-panel/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    @yield('scripts')
</body>

</html>
