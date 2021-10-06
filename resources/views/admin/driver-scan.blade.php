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
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/style.css')}}" />
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/font-awesome.min.css')}}" />
  <style type="text/css">

 
    #wrapper {
      text-align: center;
      box-sizing: border-box;
      color: #333;
      position: relative;
      margin-top: 100px;
      min-height: 50vh;
      margin-bottom: 100px;
    }
    #dialog {
      border: solid 1px #ccc;
      margin: 10px auto;
      padding: 20px 30px;
      display: inline-block;
      box-shadow: 0 0 4px #ccc;
      background-color: #FAF8F8;
      overflow: hidden;
      position: relative;
      max-width: 450px;
    }
    h4 {
      margin: 0 0 10px;
      padding: 0;
      line-height: 1.25;
    } 
    span {
      font-size: 90%;
    }
    #form {
      max-width: 240px;
      margin: 25px auto 0;
      
      input {
        margin: 0 5px;
        text-align: center;
        line-height: 80px;
        font-size: 50px;
        border: solid 1px #ccc;
        box-shadow: 0 0 5px #ccc inset;
        outline: none;
        width: 20%;
        transition: all .2s ease-in-out;
        border-radius: 3px;
        
        &:focus {
          border-color: purple;
          box-shadow: 0 0 5px purple inset;
        }
        
        &::selection {
          background: transparent;
        }
      }
      
      button {
        margin:  30px 0 50px;
        width: 100%;
        padding: 6px;
        background-color: #B85FC6;
        border: none;
        text-transform: uppercase;
      }
    }
    button {
      &.close {
        border: solid 2px;
        border-radius: 30px;
        line-height: 19px;
        font-size: 120%;
        width: 22px;
        position: absolute;
        right: 5px;
        top: 5px;
      }           
    }
    .n_text{
      text-align: center;
    }
    .btn-embossed{
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <section class="logo-banner">
    <div class="container">
      <div class="text-center">
        <img src="{{asset('admin-panel/customer-view/images/logo.png')}}" class="img-fluid" alt="">
      </div>
    </div>
  </section>
  <section class="content">
    <div id="wrapper">
      <div id="dialog">
        @if(Session::has('error'))
          <div class="otp-alert">
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
          </div>
        @endif
        <h4>Enter The 4-digit Code</h4>
        <div id="form">
          <form action="{{route('qr.driverCode')}}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="customer_id" value="{{$customerID}}">
            <input type="password"  class="n_text"  name="digit_1" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input type="password"  class="n_text"  name="digit_2" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input type="password"  class="n_text"  name="digit_3" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <input type="password"  class="n_text"  name="digit_4" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
            <div>
              <button class="btn btn-primary btn-embossed">Enter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <footer class="footer-wrapper">
    <div class="container">
      <div class="col-md-6 text__center-main">
        <div>
          <p class="m-0 ">© Copyright 2021 Milk Kitchen . All rights reserved </p>
        </div>
      </div>
      <div class="col-md-6 text-right text__center-main">
        <div>
          <p class="m-0">Designed & Developed by <a href="https://leadconcept.com/" target="_blank">LEADconcept</a></p>
        </div>
      </div>
    </div> 
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('admin-panel/customer-view/js/bootstrap.js')}}"></script>
  <script src="{{asset('admin-panel/customer-view/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin-panel/customer-view/js/index.js')}}"></script>
  <script src="{{asset('admin-panel/customer-view/js/fontawesome.js')}}"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';

      var body = $('body');

      function goToNextInput(e) {
        var key = e.which,
          t = $(e.target),
          sib = t.next('input');

        if (key != 9 && (key < 48 || key > 57)) {
          e.preventDefault();
          return false;
        }

        if (key === 9) {
          return true;
        }

        if (!sib || !sib.length) {
          sib = body.find('input').eq(0);
        }
        sib.select().focus();
      }

      function onKeyDown(e) {
        var key = e.which;

        if (key === 9 || (key >= 48 && key <= 57)) {
          return true;
        }

        e.preventDefault();
        return false;
      }
  
      function onFocus(e) {
        $(e.target).select();
      }

      body.on('keyup', 'input', goToNextInput);
      body.on('keydown', 'input', onKeyDown);
      body.on('click', 'input', onFocus);
    });
  </script>
</body>
</html>