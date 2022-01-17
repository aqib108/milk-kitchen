@extends('layouts.customer')

@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">MANAGE YOUR ACCOUNT</h2>
            </div>
            <div>
                <div>
                    <div id="accordion">
                        <div class="card custom-card">
                            <div class="card-body p-0 mb-0">
                                @if($customerDetail == null)<form id="customer-detail-info-form" method="POST"> @csrf  @else <form id="customer-detail-info-form-update" method="POST">@csrf @method('PUT') @endif
                                    <div class="form-container">
                                        <div class="row">
                                            <div class="col-lg-6" style="margin-top: 10px;">
                                                <div>
                                                    <h2 class="heading-inner-top">Business Details</h2>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_name">Business Name <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_name') is-invalid @enderror" id="business_name" name="business_name" value="{{isset($customerDetail->business_name) ? $customerDetail->business_name:''}}" placeholder="Enter Business Name">
                                                        @error('business_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_address_1') is-invalid @enderror" id="business_address_1" name="business_address_1" value="{{isset($customerDetail->business_address_1) ? $customerDetail->business_address_1:''}}" placeholder="Enter Business Address 1 etc.">
                                                        @error('business_address_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('business_address_2') is-invalid @enderror" id="business_address_2" name="business_address_2" value="{{isset($customerDetail->business_address_2) ? $customerDetail->business_address_2:''}}" placeholder="Enter Business Address 2 etc.">
                                                        @error('business_address_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_country">Suburb <span class="required-star">*</span></label>
                                                        <input type="text" name="business_country" value="{{$customerDetail->business_country ?? ''}}" placeholder="Enter Subrub Name" class="form-control @error('business_country') is-invalid @enderror" id="business_country">
                                                        @error('business_country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_region">Region <span class="required-star">*</span></label>
                                                        <input type="text" name="business_region" value="{{$customerDetail->business_region ?? ''}}" placeholder="Enter Region Name" class="form-control @error('business_region') is-invalid @enderror" id="business_region">
                                                        @error('business_region')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_city">City <span class="required-star">*</span></label>
                                                        <input type="text" name="business_city" value="{{$customerDetail->business_city ?? ''}}" placeholder="Enter City Name" class="form-control @error('business_city') is-invalid @enderror" id="business_city">
                                                        @error('business_city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_phone_no">Phone No</label>
                                                        <input type="text" class="form-control @error('business_phone_no') is-invalid @enderror" id="business_phone_no" name="business_phone_no" placeholder="Enter Phone No" value="{{isset($customerDetail->business_phone_no) ? $customerDetail->business_phone_no:''}}">
                                                        @error('business_phone_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_email">Email <span class="required-star">*</span></label>
                                                        <input type="email" class="form-control @error('business_email') is-invalid @enderror" id="business_email" name="business_email" value="{{isset($customerDetail->business_email) ? $customerDetail->business_email:''}}" placeholder="Enter Business Email">
                                                        @error('business_email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_contact_no">Contact No <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_contact_no') is-invalid @enderror" id="business_contact_no" name="business_contact_no" value="{{isset($customerDetail->business_contact_no) ? $customerDetail->business_contact_no:''}}" placeholder="Enter Business Contact No">
                                                        @error('business_contact_no')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" style="margin-top: 10px;">
                                                <div>
                                                    <h2 class="heading-inner-top">Delivery Details</h2>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_name">Delivery Name <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control  @error('delivery_name') is-invalid @enderror" id="delivery_name" name="delivery_name" value="{{isset($customerDetail->delivery_name) ? $customerDetail->delivery_name:''}}" placeholder="Enter Delivery Name">
                                                        @error('delivery_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('delivery_address_1') is-invalid @enderror" id="delivery_address_1" name="delivery_address_1" value="{{isset($customerDetail->delivery_address_1) ? $customerDetail->delivery_address_1:''}}" placeholder="Enter Delivery Address 1">
                                                        @error('delivery_address_1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('delivery_address_2') is-invalid @enderror" id="delivery_address_2" name="delivery_address_2" value="{{isset($customerDetail->delivery_address_2) ? $customerDetail->delivery_address_2:''}}" placeholder="Enter Delivery Address 2">
                                                        @error('delivery_address_2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_country">Suburb <span class="required-star">*</span></label>
                                                        <input type="text" name="delivery_country" value="{{$customerDetail->delivery_country ?? '' }}" placeholder="Enter Subrub Name" class="form-control @error('delivery_country') is-invalid @enderror" id="delivery_country">
                                                        @error('delivery_country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_region">Region <span class="required-star">*</span></label>
                                                        <input type="text" name="delivery_region" value="{{$customerDetail->delivery_region ?? '' }}" placeholder="Enter Region Name" class="form-control @error('delivery_region') is-invalid @enderror" id="delivery_region">
                                                        @error('delivery_region')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_city">City <span class="required-star">*</span></label>
                                                        <input type="text" name="delivery_city" value="{{$customerDetail->delivery_city ?? '' }}" placeholder="Enter City Name" class="form-control @error('delivery_city') is-invalid @enderror" id="delivery_city">
                                                        @error('delivery_city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6 p-0">
                                                        <label class="label-wrapper-custm" for="">Past order</label>
                                                        <div class="form-inner-section">
                                                            <a href="{{route('customer.past-orders',$user)}}">view</a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 p-0">
                                                        <label class="label-wrapper-custm" for="">Next DD
                                                            payments</label>
                                                        <!-- <p class="form-inner-section">$159.65 </p>
                                                        <p class="form-inner-section">8/23/2021</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="form-group col-md-6">
                                                    <input type="hidden" name="delivery_zone" value="{{$customerDetail->delivery_zone ?? '' }}" placeholder="Enter Zone Name" class="form-control @error('delivery_zone') is-invalid @enderror" id="delivery_zone">
                                                    @error('delivery_zone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div> 
                                        <div class="row mb-40-wrapper">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="" class="label-wrapper-custm">Delivery Notes</label>
                                                    <textarea class="form-control" id="delivery_notes" name="delivery_notes" rows="3">{{isset($customerDetail->delivery_notes) ? $customerDetail->delivery_notes:''}}</textarea>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{$user}}" id="user_id">
                                                <div style="float: right" id="button">
                                                    @if($customerDetail == null)
                                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                                    @else
                                                    <button type="submit" id="update" class="btn btn-primary" data-id="{{$user}}">Update</button>
                                                    @endif
                
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div>
                <h2 class="heading-tbl">This Weeks Deliveries</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 weekly_standing_order">
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
                        </tr>
                    </thead>
                    <tbody class="week-container-tbl">
                        @if($products != null)
                            @foreach ($products as $product)
                                <tr class="week_days" data-p-id="{{$product['id'] ?? ''}}">
                                <td class="table-td-wrapper" scope="row" style="background-color: white !important;">
                                        <a  style="cursor: pointer;" class="" data-toggle="modal" data-target="#thisWeekOrder-{{$product['id'] ?? ''}}">
                                            {{$product['name'] ?? ''}}
                                        </a>
                                        <div class="modal fade" id="thisWeekOrder-{{$product['id'] ?? ''}}" tabindex="-1" role="dialog"
                                            aria-labelledby="thisWeekOrderTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{$product['name'] ?? ''}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <img src="{{ asset('storage/' . $product['image_url']) }}" id="image" style=" width:80% ! important;">
                                                            </div>
                                                            <div class="from-group col-md-12">
                                                            <p> Price:${{$product['ctnPrice'] }} / {{$product['pack_size']}} PK Carton</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>
                                    @foreach ($weekDays as  $key=>$item)  
                                        @php $key1 = ++$key; @endphp
                                        @if(isset($deliveryZoneDay[$key1]) && $deliveryZoneDay[$key1])
                                            @php
                                                $qnty = 0;
                                                if ($item != null){
                                                    foreach ($item->WeekDay as $order){
                                                        if($order->product_id == $product['id']){
                                                            $qnty = $order->quantity;
                                                        }   
                                                    } 
                                                }  
                                            @endphp
                                            
                                            @if($item->id <= $today)
                                                    <td style="background-color: white !important;">
                                                        <input id="{{ $item->name }}" data-id-user="{{$user }}" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                                                    text-align: center;" value="{{$qnty}}" minlength="0" disabled>
                                                    </td>
                                                @else
                                                    <td style="background-color: white !important;">
                                                        <input id="{{ $item->name }}" data-id-user="{{$user }}" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                                                    text-align: center;" value="{{$qnty}}" minlength="0">
                                                    </td>
                                                @endif
                                        @else
                                            <td style="background-color: aliceblue !important;">
                                                <input id="{{ $item->name }}" data-id-user="{{ $user }}" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                                            text-align: center;" value="0" minlength="0" disabled>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="alert alert-danger" colspan="8" role="alert">
                                    <div>
                                        No Result(s) Found !
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div> 
        </div>
        <!-- 2nd  -->
        <div class="mb-40-wrapper">
            <div>
                <h2 class="heading-tbl">Weekly Standing Order</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-0 standing_orders">
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

                        </tr>
                    </thead>
                    <tbody class="week-container-tbl">
                        @foreach ($products as $product)
                            @if($product != null)
                                <tr class="week_days" data-p-id="{{$product['id']}}">
                                    <td class="table-td-wrapper" scope="row" style="background-color: white !important;">
                                        <a  style="cursor: pointer;" class="" data-toggle="modal" data-target="#standingOrdersModel-{{$product['id'] ?? ''}}">
                                            {{$product['name'] ?? ''}}
                                        </a>
                                        <div class="modal fade" id="standingOrdersModel-{{$product['id'] ?? ''}}" tabindex="-1" role="dialog"
                                            aria-labelledby="standingOrdersModelTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{$product['name'] ?? ''}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <img src="{{ asset('storage/' . $product['image_url']) }}" id="image" style ="width:80% ! important;">
                                                            </div>
                                                            <div class="from-group col-md-12">
                                                            <p> Price:${{$product['ctnPrice'] }} / {{$product['pack_size']}} PK Carton</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>
                                    @foreach ($WeekDayForStandingOrder as  $key=>$item)
                                        @php $key1 = ++$key; @endphp
                                        @if(isset($deliveryZoneDay[$key1]) && $deliveryZoneDay[$key1])
                                            @php
                                                $qnty = 0;
                                                if ($item != null){
                                                    foreach ($item->WeekDayForStandingOrder as $order){
                                                        if($order->product_id == $product['id']){
                                                            $qnty = $order->quantity;
                                                        }   
                                                    } 
                                                }  
                                            @endphp
                                            <td style="background-color: white !important;">
                                                <input id="{{ $item->name }}" data-id-user="{{ $user }}" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                                    text-align: center;" value="{{$qnty}}" minlength="0" >
                                            </td>
                                        @else
                                            <td style="background-color: aliceblue !important;">
                                                <input id="{{ $item->name }}" data-id-user="{{ $user }}" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                                            text-align: center;" value="0" minlength="0" disabled>
                                            </td>
                                        @endif
                                    @endforeach
                                </tr> 
                            @else
                                <tr>
                                    <td class="alert alert-danger" colspan="8" role="alert">
                                        <div>
                                            No Result(s) Found !
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @php
        $footervalue= \App\Models\Setting::whereName('Footer_Value')->first();
        @endphp
        <h4 style="margin-left: 30%;">{{ $footervalue->value }}</h4>
    </div>
@endsection 
@section('scripts')
    <!---- CUSTOMER FORM UPDATE AND STORE FUNCTION SCRIPT ----> 
    <script>
        $(document).ready(function(){
            var region_name ='';
            var zone_name ='';
            region_name =`<?php echo $customerDetail->delivery_region ?? '' ;?>`;
            zone_name =`<?php echo $customerDetail->delivery_zone ?? '' ;?>`;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /// Phone Number
            $('#business_contact_no').mask('0000-0000000');
            //Submit Form Function
            $("#customer-detail-info-form").on("submit", function(event){
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: "{{route('customer-detail.store')}}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        if(response.success)
                        {
                            $('#submit').hide();
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.success,
                            });
                            location.reload();
                        }
                    },
                }); 
            });
            //Update Form Function
            $("#customer-detail-info-form-update").on("submit", function(event){
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    }
                });
                var formData = new FormData(this);
                $.ajax({
                    
                    type: "POST",
                    data: formData,
                    url: "{{route('customer-detail.update',$user)}}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        console.log(response);
                        if(response.success)
                        {
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.success,
                            });
                            location.reload();
                        }
                    },
                });   
            });
            // Product Selection
            $('body').on('change','.weekly_standing_order .week_days td input', function(){
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
                            'qnty':qnty,
                            'region' : region_name,
                            'zone' : zone_name,
                        },
                        url: 'home/product-orders',
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
            })
            // Furth Product Selection
            $('body').on('change', '.standing_orders .week_days td input', function() {
                let product_id = $(this).parent('td').parent('tr').attr('data-p-id');
                let day_id = $(this).attr('data-id');
                let qnty = $(this).val();
             
                if (qnty < 0) {
                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000,
                        icon: 'error',
                        title: 'Quantity should not be less than 0',
                    });
                    $(this).val(0);
                } else {
                    $.ajax({
                        type: "POST",
                        data: {
                            'day_id': day_id,
                            'product_id': product_id,
                            'region' : region_name,
                            'zone' : zone_name,
                            'qnty': qnty
                        },
                        url: "{{route('admin.standing-orders',$user)}}",
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    position: 'top-end',
                                    toast: true,
                                    showConfirmButton: false,
                                    timer: 2000,
                                    icon: 'success',
                                    title: response.message,
                                });
                            } else {
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
    <!---- PRODUCT SCRIPT ---->
    <script>
        $(document).ready(function(){
            // Monday
            $('#monday').keyup(function() {
                var dInputMo = this.value;
                console.log(dInputMo);
            });
            // Tuesday
            $('#tuesday').keyup(function() {
                var dInputTu = this.value;
                console.log(dInputTu);
            });
            // Wednesday
            $('#wednesday').keyup(function() {
                var dInputWe = this.value;
                console.log(dInputWe);
            });
            // Thursday
            $('#thursday').keyup(function() {
                var dInputTh = this.value;
                console.log(dInputTh);
            });
            // Friday
            $('#friday').keyup(function() {
                var dInputFr = this.value;
                console.log(dInputFr);
            });
        });
    </script>
    <!---- SUBMIT FORM VALIDATION SCRIPT  ---->
    <script>
        // Submit Form
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                }
            });
            $('#customer-detail-info-form').validate({
                rules: {
                    business_name: {
                        required: true,
                    },
                    business_address_1: {
                        required: true,
                    },
                    business_country: {
                        required: true,
                    },
                    business_region: {
                        required: true,
                    },
                    business_city: {
                        required: true,
                    },
                    business_email: {
                        required: true,
                        email: true,
                    },
                    business_contact_no: {
                        required: true,
                        minlength: 11
                    },
                    delivery_name: {
                        required: true,
                    },
                    delivery_address_1: {
                        required: true,
                    },
                    delivery_country: {
                        required: true,
                    },
                    delivery_region: {
                        required: true,
                    },
                    delivery_city: {
                        required: true,
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    business_name: {
                        required: "Please enter a business name",
                        business_name: "Your Business Name Must Be 6 characters"
                    },
                    business_address_1: {
                        required: "Please enter a business address 1 123 etc.",
                        business_name: "Your Business Name Must Be 6 characters"
                    },
                    business_contact_no: {
                        required: "Please enter a phone number",
                        business_contact_no: "Your phone number must be at least 11 characters long "
                    },
                    delivery_name: {
                        required: "Please enter a delivery name",
                        delivery_name: "Your delivery Name Must Be 6 characters"
                    },
                    delivery_address_1: {
                        required: "Please enter a delivery address 1 123 etc.",
                        delivery_address_1: "Your delivery Name Must Be 6 characters"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <!----- UPDATE FORM VALIDATION SCRIPT ---->
    <script>
        $(function () {
            $.validator.setDefaults({
                submitHandler: function () {}
            });
            $('#customer-detail-info-form-update').validate({
                rules: {
                    business_name: {
                        required: true,
                    },
                    business_address_1: {
                        required: true,
                    },
                    business_country: {
                        required: true,
                    },
                    business_region: {
                        required: true,
                    },
                    business_city: {
                        required: true,
                    },
                    business_email: {
                        required: true,
                        email: true,
                    },
                    business_contact_no: {
                        required: true,
                        minlength: 11
                    },
                    delivery_name: {
                        required: true,
                    },
                    delivery_address_1: {
                        required: true,
                    },
                    delivery_country: {
                        required: true,
                    },
                    delivery_region: {
                        required: true,
                    },
                    delivery_city: {
                        required: true,
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    business_name: {
                        required: "Please enter a business name",
                        business_name: "Your Business Name Must Be 6 characters"
                    },
                    business_address_1: {
                        required: "Please enter a business address 1 123 etc.",
                        business_name: "Your Business Name Must Be 6 characters"
                    },
                    business_contact_no: {
                        required: "Please enter a phone number",
                        business_contact_no: "Your phone number must be at least 11 characters long "
                    },
                    delivery_name: {
                        required: "Please enter a delivery name",
                        delivery_name: "Your delivery Name Must Be 6 characters"
                    },
                    delivery_address_1: {
                        required: "Please enter a delivery address 1 123 etc.",
                        delivery_address_1: "Your delivery Name Must Be 6 characters"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection