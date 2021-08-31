@extends('admin.layouts.admin')
@section('title', 'View Order')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('order.index')}}" class="btn btn-dark">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">View Order</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <td>{{$order->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <td>{{$order->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td>{{$order->product->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Day</th>
                                        <td> <span class="badge badge-primary">{{$order->day->name}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{$order->quantity}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($order->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else                                          
                                                <span class="badge badge-danger">Suspended</span>
                                            @endif
                                          
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
