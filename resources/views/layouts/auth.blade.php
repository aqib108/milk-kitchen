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
        <title>Milk Kitchen</title>
        <link rel="stylesheet" href="{{asset('customer/css/bootstrap.css')}}" />
        <link rel="stylesheet" href="{{asset('customer/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('customer/css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('customer/css/font-awesome.min.css')}}" />
    </head>
    <body>
        @include('layouts.include.auth-header')
            @yield('content')
        @include('layouts.include.auth-footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{asset('customer/js/bootstrap.js')}}"></script>
        <script src="{{asset('customer/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('customer/js/index.js')}}"></script>
        <script src="{{asset('customer/js/fontawesome.js')}}"></script>
        @yield('scripts')
    </body>
</html>