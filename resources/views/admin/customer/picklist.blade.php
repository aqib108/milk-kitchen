@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FOOD SERVICE PORTAL</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('customer.customer-report') }}"
                                class="btn btn-dark">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div>
                <div class="text-center">
                    <h2 class="heading-wrapper">Packing Slip</h2>
                </div>
                <div class="___class_+?10___">
                    <div class="form-container pt-4">
                        <div class="row">
                            <div class="col-lg-6 border-riht-clr">
                                <div>
                                    <h2 class="heading-inner-top">
                                        @isset($customer[0]->business_name)
                                            {{ $customer[0]->business_name }}
                                        @endisset
                                    </h2>
                                </div>
                                <div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Address 1:
                                            <span>@isset($customer[0]->business_address_1){{ $customer[0]->business_address_1 }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Address 2:
                                            <span>@isset($customer[0]->business_address_2){{ $customer[0]->business_address_2 }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Suburb:
                                            <span>@isset($customer[0]->business_country){{ $customer[0]->business_country }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            City:
                                            <span>@isset($customer[0]->business_city){{ $customer[0]->business_city }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Region:
                                            <span>@isset($customer[0]->business_region){{ $customer[0]->business_region }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Phone No:
                                            <span>@isset($customer[0]->business_phone_no){{ $customer[0]->business_phone_no }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Email:
                                            <span>@isset($customer[0]->business_email){{ $customer[0]->business_email }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Contact No:
                                            <span>@isset($customer[0]->business_contact_no){{ $customer[0]->business_contact_no }}@endisset</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <h2 class="heading-inner-top">
                                        @isset($customer[0]->delivery_name){{ $customer[0]->delivery_name }}@endisset
                                    </h2>
                                </div>
                                <div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Address 1:
                                            <span>@isset($customer[0]->delivery_address_1){{ $customer[0]->delivery_address_1 }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Address 2:
                                            <span>@isset($customer[0]->delivery_address_2){{ $customer[0]->delivery_address_2 }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Suburb:
                                            <span>@isset($customer[0]->delivery_country){{ $customer[0]->delivery_country }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            City:
                                            <span>@isset($customer[0]->delivery_city){{ $customer[0]->delivery_city }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Region:
                                            <span>@isset($customer[0]->delivery_region){{ $customer[0]->delivery_region }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            GST Number: <span>33030400923</span>
                                        </p>

                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Invoice Number: <span>33030400923</span>
                                        </p>

                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Period Covered: <span>-------------</span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40-wrapper">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="label-wrapper-custm">Delivery Notes:</label>
                                    <div class="box1">
                                        <span>@isset($customer[0]->delivery_notes){{ $customer[0]->delivery_notes }}@endisset</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-40-wrapper">
                <div class="col-lg-12">
                    <h2 class="heading-tbl">Delivery Items</h2>
                </div>
                <div class="col-lg-4">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="table-th-wrapper" scope="col">Product</th>
                                    <th class="table-th-wrapper" scope="col">Total Cartons</th>
                                </tr>
                            </thead>
                            <tbody class="week-container-tbl">
                                @foreach ($products as $product)
                                    <tr class="week_days_1">
                                    <td class="table-td-wrapper" scope="row" style="background-color: white !important; width: 175px; text-align:center;">
                                        {{ $product['name'] }}
                                    </td>
                                    <td style="background-color: white !important; width: 175px; text-align:center;">
                                        <div class="quantity" >
                                            {{ $product['carton'] }}
                                        </div>

                                    </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table table-bordered mb-0 weekly_standing_order">
                            <tbody class="week-container-tbl">
                                <tr>
                                    <th style="width: 175px; text-align: center;">Total Carton</th>
                                    <td id="total_ctns">

                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-2 text-center">
                    <b>Received in full</b>
                    <hr>
                </div>
                @if(auth()->user()->hasRole('Driver') || auth()->user()->hasRole('Admin'))
                    <div class="col-lg-4">
                        {!! QrCode::size(150)->generate(route('qr.driverScan',['id'=>$customer[0]->id,'productId'=>$productOrderId])) !!}
                    </div>
                @else
                    <div class="col-lg-4">
                        @if(isset($driver_image))
                            <img src="{{ asset('storage/'.$driver_image->image_url) }}" id="image" 
                            style="width: 75%;" />
                        @else
                            <img src="{{asset('admin-panel/images/no-image.png')}}" alt=""  style="width: 75%;">
                        @endif
                    </div>
                @endif 
            </div>
           
            <div class="col-lg-12">
                <h2 class="heading-tbl">Edit History</h2>
            </div>
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <tr>
                        <td>28-sep</td>
                        <td>Reason notes are display here</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
        <br>
    
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
