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
    <link rel="stylesheet" href="{{ asset('customer-panel/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer-panel/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer-panel/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer-panel/css/font-awesome.min.css') }}" />
</head>

<body>
    <section class="logo-banner2">
        <div class="container">
            <div class="flex-wraper">
                <div class="___class_+?3___">
                    <img src="{{ asset('customer-panel/images/logo.png') }}" class="img-fluid" alt="">
                </div>
                <div>
                    <h2 class="heading-one-banner">FOOD SERVICE PORTAL</h2>
                </div>

            </div>


        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <div>
                <div class="text-center">
                    <h2 class="heading-wrapper">INVOICE / STATEMENT</h2>
                </div>
                <div class="___class_+?10___">


                    <div class="form-container pt-4">
                        <div class="row">
                            <div class="col-lg-6 border-riht-clr">
                                <div>
                                    <h2 class="heading-inner-top">{{ $customer[0]->business_name }}
                                    </h2>
                                </div>
                                <form class="custom-form">
                                    <div>
                                        <div>
                                            <p class="label-wrapper-custm">Address 1</p>
                                            <span>{{ $customer[0]->business_address_1 }}</span>

                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Address 2 </p>
                                            <span>{{ $customer[0]->business_address_2 }}</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Suburb</p>
                                            <span>{{ $customer[0]->bcountry->name }}</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">City</p>
                                            <span>{{ $customer[0]->bcity->name }}</span>
                                        </div>

                                        <div>
                                            <p class="label-wrapper-custm">Region</p>
                                            <span>{{ $customer[0]->bstate->name }}</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Phone</p>
                                            <span>{{ $customer[0]->business_phone_no }}</span>
                                        </div>

                                        <div>
                                            <p class="label-wrapper-custm">Email</p>
                                            <span>{{ $customer[0]->business_email }}</span>
                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Contact</p>
                                            <span>+{{ $customer[0]->business_contact_no }}</span>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <h2 class="heading-inner-top">{{ $customer[0]->delivery_name }}
                                    </h2>
                                </div>
                                <form class="custom-form">
                                    <div>
                                        <div>
                                            <p class="label-wrapper-custm">Address 1</p>
                                            <span>{{ $customer[0]->delivery_address_1 }}</span>

                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Address 2 </p>
                                            <span>{{ $customer[0]->delivery_address_2 }}</span>

                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">Suburb</p>
                                            <span>{{ $customer[0]->dcountry->name }}</span>

                                        </div>
                                        <div>
                                            <p class="label-wrapper-custm">City</p>
                                            <span>{{ $customer[0]->dcity->name }}</span>

                                        </div>

                                        <div>
                                            <p class="label-wrapper-custm">Region</p>
                                            <span>{{ $customer[0]->dstate->name }}</span>

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
            <div>
                <div>
                    <h2 class="heading-tbl">Related Deliveries</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="table-th-wrapper" scope="col"></th>
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
                            {{-- {{ dd($orders->pluck('quantity')) }} --}}
                            @foreach ($orders as $product)
                                <tr class="week_days" data-p-id="{{ $product->product->id }}">
                                    <td class="table-td-wrapper" scope="row">{{ $product->product->name }}</td>
                                    <td>
                                        @if ($product->day->name == 'Monday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td>
                                        @if ($product->day->name == 'Tuesday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td>
                                        @if ($product->day->name == 'Wednesday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td>
                                        @if ($product->day->name == 'Thursday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td>
                                        @if ($product->day->name == 'Friday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td>
                                        @if ($product->day->name == 'Saturday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td>
                                        @if ($product->day->name == 'Sunday')
                                            {{ $product->quantity }}
                                        @else {{ '' }} @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="custom-colspan" colspan="10"></td>
                                <td class="text-left-wrapper">Sub Total</td>
                                <td class="text-right-wrapper">$1050.333</td>
                            </tr>
                            <tr>
                                <td class="custom-colspan" colspan="10"></td>
                                <td class="text-left-wrapper">Freight</td>
                                <td class="text-right-wrapper">$109</td>
                            </tr>
                            <tr>
                                <td class="custom-colspan" colspan="10"></td>
                                <td class="text-left-wrapper">GST 15%</td>
                                <td class="text-right-wrapper">$112</td>
                            </tr>
                            <tr>
                                <td class="custom-colspan" colspan="10"></td>
                                <td class="text-left-wrapper grand-total"> Total</td>
                                <td class="text-right-wrapper grand-total-value">$10330.333</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer-wrapper-two">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text__center-main">
                    <div>
                        <p class="m-0 ">© Copyright 2021 Milk Kitchen . All rights reserved </p>
                    </div>
                </div>
                <div class="col-md-6 text-right text__center-main">
                    <div>
                        <p class="m-0">Designed & Developed by <a href="https://leadconcept.com/"
                                target="_blank">LEADconcept</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('customer-panel/js/bootstrap.js') }}"></script>
    <script src="{{ asset('customer-panel/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('customer-panel/js/index.js') }}"></script>
    <script src="{{ asset('customer-panel/js/fontawesome.js') }}"></script>
</body>

</html>
