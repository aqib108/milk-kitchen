<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Statement Pdf</title>
    <link href="http://www.milkkitchen.leadconcept.info/public/pdf.css" rel="stylesheet">
    <link rel="stylesheet" href="http://www.milkkitchen.leadconcept.info/public/admin-panel/customer-view/css/font-awesome.min.css" />
    
</head>
<body>
    <section style="background-color: #757170; padding: 6px 0; height: 50px !important;">
        <div class="">
            <div class="flex-wraper" style="display:flex; ">
                <div>
                    <img src="data:image/png;base64,{{ $image ?? '' }}" style="width: 200px; height:50px;" class="img-fluid" alt="">
                </div>
                <div>
                    <h2 class="heading-one-banner" style="margin: 0px; margin-top: 16px; font-size: 20px; color: #ffffff;font-weight: 700;font-family: 'Roboto-Medium';text-align: center;text-transform: uppercase;">FOOD SERVICE PORTAL</h2>
                </div>
                
            </div>


        </div>
    </section>
    <section  style="padding:0px !important;">
        <div class="container">
            <div>
                <div class="text-center">
                    <h2 style=" font-size: 22px;
                    color: #010101;
                    padding: 10px 0;
                    margin: 0px;    
                    font-weight: 700;
                    font-family: 'Roboto-Bold';
                    text-align: center;">INVOICE / STATEMENT</h2>
                </div>
                <div>
                    <div class="form-container pt-4">
                        <div class="row">
                            <div class="main-container border-riht-clr">
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
                            <div class="main-container" style="padding-left: 10px !important;">
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
                                        <div class="box1" style="padding:10px;">
                                            <span>@isset($customer[0]->delivery_notes){{ $customer[0]->delivery_notes }}@endisset</span>
                                        </div>
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
                    <table class="table table-bordered mb-0 w-100" style="width:100%;">
                        <thead>
                            <tr>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Product Name</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Monday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Tuesday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Wednesday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Thursday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Friday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Saturday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Sunday</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Total Ctns</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Price</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Discount</th>
                                <th style="background-color: #94d60a; font-size: 11px; color: #ffffff; font-weight: 500; font-family: 'Roboto-Medium'; text-align:center !important; padding: 5px 6px;" scope="col">Extention</th>
                            </tr>
                        </thead>
                        <tbody class="week-container-tbl">
                            @php
                                $subtotal=0;
                            @endphp
                            @foreach ($products as $product)
                                <tr class="week_days" data-p-id="{{$product['id']}}">
                                    <td class="table-td-wrapper" scope="row">{{$product['name']}}</td>
                                    @php $total=0;  @endphp
                                    @foreach ($weekDays as $item)
                                        @php $qnty=0; $price=$product['price']; $discount=($price/ 100) * 10;@endphp
                                        @if($item->productOrder->isNotEmpty())
                                            @foreach ($item->productOrder as $order)
                                                @if($order->product_id == $product['id'])
                                                    @php
                                                        $total += $order->quantity;
                                                        $qnty = $order->quantity;
                                                        $extention = ($price  - (($price / 100) * 10)) * $total;
                                                    @endphp 
                                                @endif
                                            @endforeach
                                        @endif
                                        <td>
                                            {{$qnty}}
                                        </td>
                                    @endforeach 
                                    <td>
                                        {{$total}}
                                    </td>
                                    <td>
                                        {{ '$' . $price }}
                                    </td>
                                    <td>
                                        {{ '$' . $discount }}
                                    </td>
                                    <td>
                                        {{ '$' . $extention}}
                                        @php $subtotal +=$extention @endphp
                                    </td>
                                </tr> 
                            @endforeach
                            <tr>
                                <td class="custom-colspan" colspan="8"></td>
                                <td colspan="3" class="text-left-wrapper">Sub Total</td>
                                <td class="text-right-wrapper">
                                    {{$subtotal}}
                                </td>
                            </tr>
                            <tr>
                                <td class="custom-colspan" colspan="8"></td>
                                <td colspan="3" class="text-left-wrapper">Freight</td>
                                <td class="text-right-wrapper">$ -</td>
                            </tr>
                            <tr>
                                <td class="custom-colspan" colspan="8"></td>
                                <td colspan="3" class="text-left-wrapper">GST 15%</td>
                                <td class="text-right-wrapper gst">
                                    {{ ($subtotal * 15) /100 }}
                                    @php
                                        $gst = ($subtotal * 15) /100;
                                    @endphp
                                </td>
                            </tr>
                            <tr>
                                <td class="custom-colspan" colspan="8"></td>
                                <td colspan="3" class="text-left-wrapper grand-total"> Total</td>
                                <td class="text-right-wrapper grand-total-value">
                                    {{$subtotal+$gst}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
    </section>
    <table style=" background-color: #757170;  padding:0; height:40px; width:100%;">
        <tr>
            <td>
                <div style="padding:5px;">
                    <p class="m-0" style="font-size: 12px;  color: #ffffff; margin: 0px !important;  font-weight: 400; font-family: 'Roboto-Regular'; margin: 0px">© Copyright 2021 Milk Kitchen . All rights reserved </p>
                </div>
            </td>
            <td>
                <div style="text-align: right; padding:5px;">
                    <p class="m-0" style="  font-size: 12px;  color: #ffffff; margin: 0px !important; font-weight: 400; font-family: 'Roboto-Regular'; margin: 0px">Designed & Developed by <a href="https://leadconcept.com/"
                       style="font-size: 12px;  color: #ffffff; margin: 0px !important; font-weight: 400; font-family: 'Roboto-Regular';"     target="_blank">LEADconcept</a></p>
                </div>
            </td>
        </tr>
    </table>
    <style>
        .main-container{
            width: 50%;
            float: left !important;
        }
    </style>
</body>
</html>