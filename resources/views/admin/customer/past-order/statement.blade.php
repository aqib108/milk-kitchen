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
                <div class="heading" style="text-align: center; margin-left: 440px;">
                    <h4 ><b>STATEMENT</b></h4>  
                </div>
                <div class="downad" style="margin-left: 420px; font-size: 20px;">
                    <a href="{{route('customer.statementPdf',[$customerID,$startDate,$endDate,$region])}}">
                        <i class="fas fa-download" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div>
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
                                            Suburb: <span>@isset($customer[0]->business_country){{ $customer[0]->business_country }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            City: <span>@isset($customer[0]->business_city){{ $customer[0]->business_city }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Region: <span>@isset($customer[0]->business_region){{ $customer[0]->business_region }}@endisset</span>
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
                                        <!-- @isset($customer[0]->delivery_name){{ $customer[0]->delivery_name }}@endisset -->
                                          Milk Kitchen Ltd
                                    </h2>
                                </div>
                                <div>
                                    <!-- <div>
                                        <p class="label-wrapper-custm">
                                             <span>@isset($customer[0]->delivery_address_1){{ $customer[0]->delivery_address_1 }}@endisset</span>
                                        </p>
                                    </div> -->
                                    <!-- <div>
                                        <p class="label-wrapper-custm">
                                            Address 2: <span>@isset($customer[0]->delivery_address_2){{ $customer[0]->delivery_address_2 }}@endisset</span>
                                        </p>
                                    </div> -->
                                    <div>
                                        <p class="label-wrapper-custm">
                                            GST : <span>101-508-838</span>
                                        </p> 
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                       
                                       Date :<span>{{ $endDate}}</span>
                                      
                                        </p>
                                    </div> 
                                    <div>
                                        <p class="label-wrapper-custm">
                                      
                                        
                                            Sales Period :<span>{{ $startDate }} --- {{$endDate}}</span>
                                       
                                        </p>
                                    </div> 
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Payment Will be deducted from your bank account 10 days from the date of this statement. 
                                        </p>
                                        
                                    </div>
                                    <!-- <div>
                                        <p class="label-wrapper-custm">
                                            Suburb: <span>@isset($customer[0]->delivery_country){{ $customer[0]->delivery_country }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            City:  <span>@isset($customer[0]->delivery_city){{ $customer[0]->delivery_city }}@endisset</span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Region: <span>@isset($customer[0]->delivery_region){{ $customer[0]->delivery_region }}@endisset</span>
                                        </p>
                                    </div> -->
                                    <!-- <div>
                                        <p class="label-wrapper-custm">
                                            Invoice Number: <span>33030400923</span>
                                        </p>
                                        
                                    </div>
                                    <div>
                                        <p class="label-wrapper-custm">
                                            Period Covered:  <span>-------------</span>
                                        </p>
                                        
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mb-40-wrapper">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="" class="label-wrapper-custm">Delivery Notes:</label>
                                    <div class="box1">
                                        <span>@isset($customer[0]->delivery_notes){{ $customer[0]->delivery_notes }}@endisset</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <h2 class="heading-tbl">Related Deliveries</h2>
                </div>
                <div class="table-responsive" style="overflow: hidden;">
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
                                <tr class="week_days" data-p-id="{{$product['id']}}">
                                    <td class="table-td-wrapper" scope="row" style="background-color: white !important;">
                                        {{$product['name']}}
                                    </td>
                                    @foreach ($weekDays as $item)

                                        @php
                                            $qnty = 0;
                                            if ($item->productOrder->isNotEmpty()){
                                                foreach ($item->productOrder as $order){
                                                    if($order->user_id == $customerID){
                                                        if($order->product_id == $product['id']){
                                                            $qnty = $order->quantity;
                                                        }
                                                    }   
                                                }
                                            }
                                        @endphp
                                        @if($qnty != null)
                                            <td style="background-color: white !important;">
                                                {{ $qnty }}
                                            </td>
                                        @else
                                            <td disabled style="background-color: aliceblue !important;">
                                               0 
                                            </td>
                                        @endif
                                    @endforeach
                                    <td style="background-color: white !important;">
                                        @php $total=0; @endphp
                                        @foreach ($weekDays as $item)
                                            @if ($item->productOrder->isNotEmpty())
                                                @foreach ($item->productOrder as $order)
                                                    @if($order->user_id == $customerID)
                                                        @if($order->product_id == $product['id'])
                                                            @php $total += $order->quantity; @endphp                                                       
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif 
                                        @endforeach
                                        {{ $total }}
                                    </td>
                                    <td style="background-color: white !important;">
                                        {{ '$' . number_format($product['price'],2) }}
                                    </td>
                                    <td style="background-color: white !important;">
                                        {{ '$' . ($product['price']/ 100) * 10 }}
                                    </td>
                                    <td style="background-color: white !important;">
                                        {{ '$' . number_format(($product['price']  - (($product['price'] / 100) * 10)) * $total,2)}}
                                        <input type="hidden" class="extention" value="{{($product['price']  - (($product['price'] / 100) * 10)) * $total}}">
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

            $('.subtotal').val('$' + value.toFixed(2));
            var gst = (value * 15) /100;
            var total =parseFloat(value)+parseFloat(gst);
            $('.gst').val('$' + gst.toFixed(2));
            $('.totalprice').val('$' + total.toFixed(2));
        });
    </script>
@endsection