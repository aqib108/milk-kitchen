@extends('admin.layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <a href=""
                                style="color: black"> Total<br> Users </a></span>
                            <span class="info-box-number" id="industry_businesses"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href=""
                                style="color: black">Total Skills</a></span>
                            <span class="info-box-number" id="skills"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> <a href=""
                                style="color: black">Total Products</a></span>
                            <span class="info-box-number" id="type_function"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href=""
                                style="color: black">Total</a></span>
                            <span class="info-box-number" id="sub_types_level_1"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href=""
                                style="color: black">Total </a></span>
                            <span class="info-box-number" id="sub_types_level_2"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-briefcase"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="" style="color: black">  Total</a> </span>
                            <span class="info-box-number" id="sub_types_level_3"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection