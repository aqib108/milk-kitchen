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
                        <li class="breadcrumb-item"><a href="#">{{$user->name}}</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <a href="{{route('user.index') }}"
                                style="color: black"> Total<br>Admin Users </a></span>
                            <span class="info-box-number" id="total_users"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fab fa-product-hunt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href="{{route('product.index')}}"
                                style="color: black">Total Products</a></span>
                            <span class="info-box-number" id="products"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-truck"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"> <a href="{{route('user.index')}}"
                                style="color: black">Total Distributors</a></span>
                            <span class="info-box-number" id="distributor"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-motorcycle"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><a href="{{route('user.index')}}"
                                style="color: black">Total Drivers</a></span>
                            <span class="info-box-number" id="drivers"></span>
                            <div class="count tr_amount_image">
                                <img src="{{url("images/pre_loader_gif.gif")}}" style="width: 35px;"/>
                            </div> 
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                @foreach ($resultant as $key=>$value)
                @if(date('Y-m-d') == date($value['paymentDate']))
                <div class="col-lg-3 col-6">
                    <div class="info-box">
                        <a href="{{route('sale.csv',['start'=>$value['start'],'end'=>$value['end']])}}" ><p style="color:red">Click here to download</p></a>        
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            function removeImg(class_name) {
                $('.' + class_name).find('img').remove();
            }

            $.ajax({
                method: "GET",
                url: '{{route('manage.dashboard')}}',
                success: function (response) {
                    if (response.status) {
                        removeImg('tr_amount_image');
                        $('#total_users').html(response.count['users']);
                        $('#products').html(response.count['products']);
                        $('#distributor').html(response.count['distributor']);
                        $('#drivers').html(response.count['drivers']);
                    }
                }
            });
        });

    </script>
@endsection