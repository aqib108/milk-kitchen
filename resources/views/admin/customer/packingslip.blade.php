@extends('admin.layouts.admin')
@section('title', 'List Of Customer')
@section('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
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
                        <li class="breadcrumb-item"><a href="{{ route('customer.customer-report') }}" class="btn btn-dark">Back</a>
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
                                <form class="custom-form">
                                    <div>
                                        <div>
                                            <p class="label-wrapper-custm">Address 1</p>
                                            <span>@isset($customer[0]->business_address_1){{ $customer[0]->business_address_1 }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Address 2 </p>
                                            <span>@isset($customer[0]->business_address_2){{ $customer[0]->business_address_2 }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Suburb</p>
                                            <span>@isset($customer[0]->bcountry->name){{ $customer[0]->bcountry->name }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">City</p>
                                            <span>@isset($customer[0]->bcity->name){{ $customer[0]->bcity->name }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Region</p>
                                            <span>@isset($customer[0]->bstate->name){{ $customer[0]->bstate->name }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Phone</p>
                                            <span>@isset($customer[0]->business_phone_no){{ $customer[0]->business_phone_no }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Email</p>
                                            <span>@isset($customer[0]->business_email){{ $customer[0]->business_email }}@endisset</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Contact</p>
                                            <span>@isset($customer[0]->business_contact_no){{ $customer[0]->business_contact_no }}@endisset</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <h2 class="heading-inner-top">
                                        @isset($customer[0]->delivery_name){{ $customer[0]->delivery_name }}@endisset
                                        </h2>
                                    </div>
                                    <form class="custom-form">
                                        <div>
                                            <div>
                                                <p class="label-wrapper-custm">Address 1</p>
                                                <span>@isset($customer[0]->delivery_address_1){{ $customer[0]->delivery_address_1 }}@endisset</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm">Address 2 </p>
                                                <span>@isset($customer[0]->delivery_address_2){{ $customer[0]->delivery_address_2 }}@endisset</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm">Suburb</p>
                                                <span>@isset($customer[0]->dcountry->name){{ $customer[0]->dcountry->name }}@endisset</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm">City</p>
                                                <span>@isset($customer[0]->dcity->name){{ $customer[0]->dcity->name }}@endisset</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm">Region</p>
                                                <span>@isset($customer[0]->dstate->name){{ $customer[0]->dstate->name }}@endisset</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm">GST Number:</p>
                                                <span>33030400923</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm">Invoice Number</p>
                                                <span>33030400923</span>
                                            </div>
                                            <div>
                                                <p class="label-wrapper-custm"> Period Covered</p>
                                                <span>-------------</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mb-40-wrapper">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="label-wrapper-custm">Delivery Notes</label>
                                        <div class="box1">
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
                                    <tr class="week_days">
                                        <td class="table-td-wrapper" scope="row">product 1</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="week_days">
                                        <td class="table-td-wrapper" scope="row">product 2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="week_days">
                                        <td class="table-td-wrapper" scope="row">product 3</td>
                                        <td>3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <b>Received in full</b>
                        <hr>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('images/barcode.jpg')}}" width="200" alt="">
                    </div>
                </div>
            </div>
                <!-- /.col -->
            <br>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('customer-panel/js/index.js') }}"></script>
@endsection
