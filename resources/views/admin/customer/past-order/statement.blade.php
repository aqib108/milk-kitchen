@extends('admin.layouts.admin')
@section('title', 'Customer Statement')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12" >
                    <div style="text-align: center;">
                        <h4 ><b>STATEMENT</b></h4>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div>
                <div class="text-center">
                    <h2 class="heading-wrapper">INVOICE / STATEMENT</h2>
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
                <div>
                    <div>
                        <h2 class="heading-tbl">Related Deliveries</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="table-th-wrapper" scope="col">Product Name</th>
                                    <th class="table-th-wrapper" scope="col">Monday</th>
                                    <th class="table-th-wrapper" scope="col">Tuesday</th>
                                    <th class="table-th-wrapper" scope="col">Wednesday</th>
                                    <th class="table-th-wrapper" scope="col">Thursday</th>
                                    <th class="table-th-wrapper" scope="col">Friday</th>
                                    <th class="table-th-wrapper" scope="col">Saturday</th>
                                    <th class="table-th-wrapper" scope="col">Sunday</th>
                                    <th class="table-th-wrapper" scope="col">Total Ctns</th>
                                    <th class="table-th-wrapper" scope="col">Price</th>
                                    <th class="table-th-wrapper" scope="col">Discount</th>
                                    <th class="table-th-wrapper" scope="col">Extention</th>
                                </tr>
                            </thead>
                            <tbody class="week-container-tbl">
                                @foreach ($products as $product)
                                    <tr class="week_days" data-p-id="{{$product->id}}">
                                        <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                                        @foreach ($weekDays as $item)
                                            @php
                                                $qnty = 0;
                                                if ($item->orderDelivered->isNotEmpty()){
                                                    foreach ($item->orderDelivered as $order){
                                                        if($order->product_id == $product->id){
                                                            $qnty = $order->quantity;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <td>
                                               {{ $qnty }}
                                            </td>
                                        @endforeach
                                        <td>
                                            @foreach ($weekDays as $item)
                                                @php 
                                                    $total=0;
                                                    if ($item->orderDelivered->isNotEmpty()){
                                                        foreach ($item->orderDelivered as $order){
                                                            if($order->product_id == $product->id){
                                                                $total += $order->quantity;                                                        
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                {{ $total }}@break
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ '$' . $product->price }}
                                        </td>
                                        <td>
                                            {{ '$' . ($product->price/ 100) * 10 }}
                                        </td>
                                        <td>
                                            @foreach ($weekDays as $item)
                                                @php 
                                                    $total=0;
                                                    if ($item->orderDelivered->isNotEmpty()){
                                                        foreach ($item->orderDelivered as $order){
                                                            if($order->product_id == $product->id){
                                                                $total += $order->quantity;                                                        
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                <input type="hidden" value="{{$total}}"> @break
                                            @endforeach
                                            {{ '$' . ($product->price  - (($product->price / 100) * 10)) * $total}}
                                            <input type="hidden" class="extention" value="{{($product->price  - (($product->price / 100) * 10)) * $total}}">
                                        </td>
                                    </tr> 
                                @endforeach
                               
                               
                                <tr>
                                    <td class="custom-colspan" colspan="10"></td>
                                    <td class="text-left-wrapper">Sub Total</td>
                                    <td class="text-right-wrapper">
                                        <input style="border:none;background:none;" class="text-center subtotal"
                                            disabled="disabled" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-colspan" colspan="10"></td>
                                    <td class="text-left-wrapper">Freight</td>
                                    <td class="text-right-wrapper">$ -</td>
                                </tr>
                                <tr>
                                    <td class="custom-colspan" colspan="10"></td>
                                    <td class="text-left-wrapper">GST 15%</td>
                                    <td class="text-right-wrapper gst">
                                        <input style="border:none;background:none;" class="text-center gst"
                                            disabled="disabled" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="custom-colspan" colspan="10"></td>
                                    <td class="text-left-wrapper grand-total"> Total</td>
                                    <td class="text-right-wrapper grand-total-value">
                                        <input style="border:none;background:none;" class="text-center totalprice"
                                            disabled="disabled" readonly>
                                    </td>
                                </tr>
                            </tbody>
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
    <script>
        $(document).ready(function() {
            var value = 0;
            $(".extention").each(function(){
                value += +$(this).val();
            });

            $('.subtotal').val('$' + value);
            var gst = (value * 15) /100;
            var total =parseFloat(value)+parseFloat(gst);
            $('.gst').val('$' + gst);
            $('.totalprice').val('$' + total);
        });
    </script>
@endsection