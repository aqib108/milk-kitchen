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
  <meta name="csrf_token" id="csrf-token" content="{{ csrf_token() }}" />

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{asset('admin-panel/css/fileinput.css')}}" media="all" rel="stylesheet">  
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/style.css')}}" />
  <link rel="stylesheet" href="{{asset('admin-panel/customer-view/css/font-awesome.min.css')}}" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
  <style type="text/css">
  .main-section{
margin:0 auto;
padding: 20px;
margin-top: 100px;
background-color: #fff;
box-shadow: 0px 0px 20px #c1c1c1;
}
.fileinput-remove,
.fileinput-upload{
display: none;
}
    body{
      margin: 0px;
      padding: 0px;
    }
    .custom-upload{
      margin: 0px auto;
    }
    .container{
        padding-bottom:20px;
        border-radius:5px;
    }
    .center{
        text-align:center;  
    }
    #top{
        margin-top:20px;  
    }
    .btn-container{
        background:#fff;
        border-radius:5px;
        padding-bottom:20px;
        margin-bottom:20px;
    }
    .white{
        color:black;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .imgupload{
        color:#1E2832;
        padding-top:40px;
        font-size:7em;
    }
    #namefile{
        color:black;
    }
    h4>strong{
        color:#ff3f3f
    }
    .btn-primary{
        border-color: #ff3f3f !important;
        color: #ffffff;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
        background-color: #ff3f3f !important;
        border-color: #ff3f3f !important;
    }
    /*these two are set to not display at start*/
    .imgupload.ok{
        display:none;
        color:green;
    }
    .imgupload.stop{
        display:none;
        color:red;
    }
    /*this sets the actual file input to overlay our button*/ 
    #fileup{
        opacity: 0;
        -moz-opacity: 0;
        filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
        width:200px;
        cursor: pointer;
        position:absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 40px;
        height: 50px;
    }
    /*switch between input and not active input*/
    #submitbtn{
        padding:5px 50px;
        display:none;
    }
    #fakebtn{
        padding:5px 40px;
    }
    #sign{
        color:#1E2832;
        position:fixed;
        right:10px;
        bottom:10px;
        text-shadow:0px 0px 0px #1E2832;
        transition:all.3s;
    }
    #sign:hover{
        color:#1E2832;
        text-shadow:0px 0px 5px #1E2832;
    }
    .kv-zoom-body.file-zoom-content.krajee-default img {
        height: 270px !important;
        width: 370px !important;
    }
    .kv-file-content img {
        width: 259px !important;
        height: 150px !important;
        max-width: 100% !important;
        max-height: 100% !important;
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
  <section class="content custom-form">
    <div class="container center">
        <div class="row">
            <div class="col-md-12">
                <h4 class="white"><b>Custom File Upload</b></h4>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" value="{{$driverId}}" id="driverId">
            <input type="hidden" value="{{$customer->id}}" id="customerId">
            <div class="row ">
                <div class="col-md-6 custom-upload col-md-offset-3 center">
                    <div class="btn-container text-center">
                        <div class="form-group">
                            <div class="file-loading">
                                <input id="file-1" name="image_url" type="file"  class="file" data-overwrite-initial="false">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--additional fields-->
        </form>
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
  <script src="{{asset('admin-panel/js/fileinput.js')}}" type="text/javascript"></script>
  <script src="{{asset('admin-panel/js/theme.js')}}" type="text/javascript"></script>
  <script src="{{asset('admin-panel/customer-view/js/bootstrap.js')}}"></script>
  <script src="{{asset('admin-panel/customer-view/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin-panel/customer-view/js/index.js')}}"></script>
  <script src="{{asset('admin-panel/customer-view/js/fontawesome.js')}}"></script>
 <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#file-1").fileinput({
        theme: 'fa',
        type: "POST",
        data: { customerId : $('#customerId').val(),driverId : $('#driverId').val()},
        uploadUrl: "{{route('qr.uploadCap')}}",
        allowedFileExtensions: ['jpg', 'png','jpeg', 'gif'],
        overwriteInitial: false,
        maxFileSize:15000,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }    
    });
 </script>
</body>
</html>