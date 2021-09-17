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
                                <div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Address 1:  <span>@isset($customer[0]->business_address_1){{ $customer[0]->business_address_1 }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Address 2: <span>@isset($customer[0]->business_address_2){{ $customer[0]->business_address_2 }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Suburb: <span>@isset($customer[0]->bcountry->name){{ $customer[0]->bcountry->name }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            City: <span>@isset($customer[0]->bcity->name){{ $customer[0]->bcity->name }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Region: <span>@isset($customer[0]->bstate->name){{ $customer[0]->bstate->name }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Phone No: <span>@isset($customer[0]->business_phone_no){{ $customer[0]->business_phone_no }}@endisset</span>  
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Email: <span>@isset($customer[0]->business_email){{ $customer[0]->business_email }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Contact No: <span>@isset($customer[0]->business_contact_no){{ $customer[0]->business_contact_no }}@endisset</span>
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
                                                Address 1:  <span>@isset($customer[0]->delivery_address_1){{ $customer[0]->delivery_address_1 }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Address 2: <span>@isset($customer[0]->delivery_address_2){{ $customer[0]->delivery_address_2 }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Suburb: <span>@isset($customer[0]->dcountry->name){{ $customer[0]->dcountry->name }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                City:  <span>@isset($customer[0]->dcity->name){{ $customer[0]->dcity->name }}@endisset</span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">
                                                Region: <span>@isset($customer[0]->dstate->name){{ $customer[0]->dstate->name }}@endisset</span>
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
                                                Period Covered:  <span>-------------</span>
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
                                        <tr class="week_days" data-p-id="{{$product->id}}">
                                            <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                                            @php $totalCtn=0; @endphp
                                            @foreach ($weekDays as $item)
                                                @if($item->orderDelivered->isNotEmpty())
                                                    @foreach($item->orderDelivered as $order)
                                                        @if($order->product_id == $product->id)
                                                            @php $totalCtn += $order->quantity; @endphp                                                       
                                                        @endif
                                                    @endforeach
                                                @endif 
                                            @endforeach
                                            <td>
                                                {{ $totalCtn }}
                                                <input type="hidden" class="t_ctn" value="{{$totalCtn}}">
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
                    <div class="col-lg-4 text-center">
                        <b>Received in full</b>
                        <hr>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('images/barcode.jpg')}}" width="200" alt="">
                    </div>
                    <div class="col-lg-12">
                        <h2 class="heading-tbl">Edit Delivery</h2>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0 weekly_standing_order">
                                <thead>
                                    <tr>
                                        <th class="table-th-wrapper" scope="col">Product</th>
                                        <th class="table-th-wrapper" scope="col">
                                            @foreach ($weekDays as $item)
                                                @if($item->orderDelivered->isNotEmpty())
                                                    @foreach($item->orderDelivered as $order)
                                                        @if($item->id == $order->day_id)
                                                            {{$item->name}}@break;
                                                        @endif 
                                                    @endforeach
                                                @endif 
                                            @endforeach
                                        </th>
                                        <th class="table-th-wrapper" scope="col">Actually received
                                        </th>
                                        <th class="table-th-wrapper" scope="col">Reason</th>
                                    </tr>
                                </thead>
                                <tbody class="week-container-tbl" style="text-align: center;"> 
                                    @foreach ($products as $product)
                                        <tr class="week_days_1" data-p-id="{{$product->id}}">
                                            <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                                            @php $totalCtn=0; @endphp
                                            @foreach ($weekDays as $item)
                                                @if($item->orderDelivered->isNotEmpty())
                                                    @foreach($item->orderDelivered as $order)
                                                        @if($order->product_id == $product->id)
                                                            @php $totalCtn += $order->quantity; @endphp                                                       
                                                        @endif
                                                    @endforeach
                                                @endif 
                                            @endforeach
                                            <td>
                                                {{ $totalCtn }}
                                                <input type="hidden" class="t_ctn" value="{{$totalCtn}}">
                                            </td>
                                            @foreach ($weekDays as $item)
                                                @if($item->orderDelivered->isNotEmpty())
                                                    @foreach($item->orderDelivered as $order)
                                                        @if($item->id == $order->day_id)
                                                            <td>
                                                                <input id="{{ $item->name }}" class="form-control" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                                                text-align: center;" value="{{ $totalCtn }}" minlength="0"> @break;
                                                            </td>
                                                        @endif 
                                                    @endforeach
                                                @endif
                                                @if($item->orderDelivered->isNotEmpty())
                                                    @foreach($item->orderDelivered as $order)
                                                        @if($item->id == $order->day_id)
                                                            <td><textarea  id="{{ $item->name }}" name="reason_qty" type="text" class="form-control"></textarea></td>@break;
                                                        @endif 
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var value = 0;
            $(".t_ctn").each(function(){
                value += +$(this).val();
            });
            total_ctns = (value);
            $('#total_ctns').append(total_ctns);

            $('body').on('change','.weekly_standing_order .week_days_1 td input', function(){
                let product_id = $(this).parent('td').parent('tr').attr('data-p-id');
                let day_id = $(this).attr('data-id');
                let qnty = $(this).val();
                if(qnty < 0){
                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000,
                        icon: 'error',
                        title: 'Quantity should not be less than 0',
                    });
                    $(this).val(0);
                }else{
                    $.ajax({
                        type: "POST",
                        data: {
                            'day_id':day_id,
                            'product_id':product_id,
                            'qnty':qnty
                        },
                        url: "{{route('customer.edit-delivery-orders',$customerID)}}",
                        success: function (response) {
                            if(response.status)
                            {
                                Swal.fire({
                                    position: 'top-end',
                                    toast: true,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    icon: 'success',
                                    title: response.message,
                                });
                            }else{
                                Swal.fire({
                                    position: 'top-end',
                                    toast: true,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    icon: 'error',
                                    title: response.success,
                                });
                            }
                        },
                    }); 
                   
                }
            });
        });
    </script>
@endsection
