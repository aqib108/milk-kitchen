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
                                @foreach ($products as $pro)
                                    <tr class="week_days" data-p-id="{{ $pro->id }}">
                                        <td class="table-td-wrapper" scope="row">{{ $pro->name }}</td>
                                        @foreach ($weekDays as $item)
                                            @php
                                                $qnty = 0;
                                                if ($item != null) {
                                                    foreach ($item->WeekDay as $order) {
                                                        if ($order->product_id == $pro->id) {
                                                            $qnty = $order->quantity;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <td>
                                                @if($qnty == 0){{ '' }}@else{{ $qnty }}@endif
                                            </td>
                                        @endforeach
                                        <td>
                                            @php $total=0; @endphp
                                            @foreach ($orders as $item)
                                                @if ($pro->id == $item->product_id)
                                                    @php $total += $item->quantity; @endphp
                                                @endif
                                            @endforeach
                                            {{ $total }}
                                        </td>
                                        <td>
                                            @php $price=0; @endphp
                                            @foreach ($orders as $item)
                                                @if ($pro->id == $item->product_id)
                                                    @php $price = $total * $item->product->price @endphp
                                                @break
                                                @endif
                                            @endforeach
                                            {{ '$' . $item->product->price }}
                                            <input type="hidden" value="{{ $price }}" class="price">
                                        </td>
                                        <td>
                                            {{ '$' . ($item->product->price / 100) * 10 }}
                                            <input type="hidden" value="{{ ($price / 100) * 10 }}"
                                                class="discount">
                                        </td>
                                        <td>
                                           {{ '$' . $price - ((($item->product->price / 100) * 10) * $total) }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('customer-panel/js/index.js') }}"></script>
    <script>
        $(document).ready(function() {

            var sum = 0,dis = 0;

            $(".price").each(function() {
                sum += +$(this).val();
            });
            $(".discount").each(function() {
                dis += +$(this).val();
            });
            
            var subtotal = sum - dis;
            var gst = (subtotal * 15) /100;
            var total =parseFloat(subtotal)+parseFloat(gst);

            $('.subtotal').val('$' + subtotal);
            $('.gst').val('$' + gst);
            $('.totalprice').val('$' + total);
        });
    </script>
@endsection
