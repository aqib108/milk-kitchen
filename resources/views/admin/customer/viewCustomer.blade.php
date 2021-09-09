@extends('admin.layouts.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-panel/customer-view/css/font-awesome.min.css') }}" />
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Customer Name: <b>{{$customer->name}}</b></h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}" class="btn btn-dark">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div>
                <div>
                    <div id="accordion">
                        <div class="card custom-card">
                            <div class="card-body p-0 mb-0">
                                <form id="customer-detail-info-form-update" method="POST">@csrf 
                                    @method('PUT')
                                    <div class="form-container" >
                                        <div class="row">
                                            <div class="col-lg-6" style="margin-top: 10px;">
                                                <div>
                                                    <h2 class="heading-inner-top">Business Details</h2>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_name">Business Name <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_name') is-invalid @enderror" id="business_name" name="business_name"
                                                        value="{{isset($customerDetail->business_name) ? $customerDetail->business_name:''}}" placeholder="Enter Business Name">
                                                        @error('business_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_address_1') is-invalid @enderror" id="business_address_1" name="business_address_1"
                                                        value="{{isset($customerDetail->business_address_1) ? $customerDetail->business_address_1:''}}" placeholder="Enter Business Address 1 etc.">
                                                        @error('business_address_1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('business_address_2') is-invalid @enderror" id="business_address_2" name="business_address_2"
                                                        value="{{isset($customerDetail->business_address_2) ? $customerDetail->business_address_2:''}}" placeholder="Enter Business Address 2 etc.">
                                                        @error('business_address_2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_country_id">Suburb <span class="required-star">*</span></label>
                                                        <select name="business_country_id" class="form-control @error('business_country_id') is-invalid @enderror" id="business_country_id">
                                                        <option selected disabled>Select Country</option>
                                                        @foreach($countries as $country)                                        
                                                            <option value="{{$country->id}}" {{ isset($customerDetail->business_country_id) && $customerDetail->business_country_id == $country->id?'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                        </select>
                                                        @error('business_country_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_region_id">Region <span class="required-star">*</span></label>
                                                        <select name="business_region_id" class="form-control @error('business_region_id') is-invalid @enderror" id="business_region_id">
                                                            <option selected disabled>Select Region</option>
                                                            @foreach($regions as $region)
                                                                <option value="{{$region->id}}"
                                                                    {{ isset($customerDetail->business_region_id) && $customerDetail->business_region_id == $region->id ? "selected":""}}>{{$region->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('business_region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_city_id">City <span class="required-star">*</span></label>
                                                        <select name="business_city_id" class="form-control @error('business_city_id') is-invalid @enderror" id="business_city_id">
                                                            <option selected disabled>Select City</option>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->id}}" {{isset($customerDetail->business_city_id) && $customerDetail->business_city_id == $city->id ? "selected":""}}>
                                                                    {{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('business_city_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_phone_no">Phone No</label>
                                                        <input type="text" class="form-control @error('business_phone_no') is-invalid @enderror" id="business_phone_no" name="business_phone_no" 
                                                        placeholder="Enter Phone No" value="{{isset($customerDetail->business_phone_no) ? $customerDetail->business_phone_no:''}}">
                                                        @error('business_phone_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_email">Email <span class="required-star">*</span></label>
                                                        <input type="email" class="form-control @error('business_email') is-invalid @enderror" id="business_email" name="business_email"
                                                        value="{{isset($customerDetail->business_email) ? $customerDetail->business_email:''}}" placeholder="Enter Business Email">
                                                        @error('business_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_contact_no">Contact No  <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_contact_no') is-invalid @enderror" id="business_contact_no" name="business_contact_no"
                                                            value="{{isset($customerDetail->business_contact_no) ? $customerDetail->business_contact_no:''}}"  placeholder="Enter Business Contact No">
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
                                                        <input type="text" class="form-control  @error('delivery_name') is-invalid @enderror" id="delivery_name" name="delivery_name"
                                                            value="{{isset($customerDetail->delivery_name) ? $customerDetail->delivery_name:''}}" placeholder="Enter Delivery Name">
                                                        @error('delivery_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('delivery_address_1') is-invalid @enderror" id="delivery_address_1" name="delivery_address_1"
                                                            value="{{isset($customerDetail->delivery_address_1) ? $customerDetail->delivery_address_1:''}}" placeholder="Enter Delivery Address 1">
                                                        @error('delivery_address_1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('delivery_address_2') is-invalid @enderror" id="delivery_address_2" name="delivery_address_2"  value="{{isset($customerDetail->delivery_address_2) ? $customerDetail->delivery_address_2:''}}"
                                                        placeholder="Enter Delivery Address 2">
                                                        @error('delivery_address_2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_country_id">Suburb <span class="required-star">*</span></label>
                                                        <select name="delivery_country_id" class="form-control @error('delivery_country_id') is-invalid @enderror" id="delivery_country_id">
                                                            <option selected disabled>Select Country</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}" {{ isset($customerDetail->delivery_country_id) && $customerDetail->delivery_country_id == $country->id ?'selected':''}}>{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('delivery_country_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_region_id">Region <span class="required-star">*</span></label>
                                                        <select name="delivery_region_id" class="form-control @error('delivery_region_id') is-invalid @enderror" id="delivery_region_id">
                                                            <option selected disabled>Select Region</option>
                                                            @foreach($dregions as $region)
                                                                <option value="{{$region->id}}"
                                                                    {{isset($customerDetail->delivery_region_id) && $customerDetail->delivery_region_id == $region->id ? "selected":""}}>{{$region->name}}
                                                                </option>
                                                            @endforeach
                                                           
                                                        </select>
                                                        @error('delivery_region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_city_id">City <span class="required-star">*</span></label>
                                                        <select name="delivery_city_id" class="form-control @error('delivery_city_id') is-invalid @enderror" id="delivery_city_id">
                                                            <option selected disabled>Select City</option>
                                                            @foreach($dcities as $city)
                                                                <option value="{{$city->id}}" {{isset($customerDetail->delivery_city_id) && $customerDetail->delivery_city_id == $city->id ? "selected":""}}>
                                                                    {{$city->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('delivery_city_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6 p-0">
                                                        <label class="label-wrapper-custm" for="">Past order</label>
                                                        <div class="form-inner-section">
                                                            <a href="{{route('customer.past-orders',$customer->id)}}">view</a>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 p-0">
                                                        <label class="label-wrapper-custm" for="">Next DD
                                                            payments</label>
                                                        <p class="form-inner-section">$159.65 </p>
                                                        <p class="form-inner-section">8/23/2021</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-40-wrapper">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="" class="label-wrapper-custm">Delivery Notes</label>
                                                    <textarea class="form-control" id="delivery_notes" name="delivery_notes" rows="3">{{isset($customerDetail->delivery_notes) ? $customerDetail->delivery_notes:''}}</textarea>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{$customerID}}" id="user_id">
                                                <div class="custom-button mt-4 " style="float: right;">
                                                    <button type="submit" id="update" class="btn btn-primary  px-4 mb-0">Update</button>
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
                            @foreach ($products as $product)
                                <tr class="week_days" data-p-id="{{$product->id}}">
                                    <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                                    @foreach ($weekDays as $item)
                                        @php
                                            $qnty = 0;
                                            if ($item != null){
                                                foreach ($item->WeekDay as $order){
                                                    if($order->product_id == $product->id){
                                                        $qnty = $order->quantity;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <td>
                                            <input id="{{ $item->name }}" data-id-user="{{ $customer->id }}" data-id="{{ $item->id }}" type="number" name="{{ strtolower($item->name) }}" style="width: 80px;
                                            text-align: center;" value="{{$qnty}}" minlength="0">
                                        </td>
                                    @endforeach
                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-40-wrapper">
                <div>
                    <h2 class="heading-tbl">Weekly Standing Order</h2>
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
    
                            </tr>
                        </thead>
                        <tbody class="week-container-tbl">
                            <tr>
                                <td class="table-td-wrapper" scope="row">Product 1</td>
                                <td>3</td>
                                <td>4</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
    
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('admin-panel/customer-view/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/js/index.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/js/fontawesome.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin-panel/customer-view/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                    url: "{{route('customer-detail.update',$customer->id)}}",
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
                            'qnty':qnty
                        },
                        url: "{{route('admin.customer-orders',$customer->id)}}",
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
            //Business Country City States Function on change dropdown
            $('#business_country_id').on('change', function () {
                var country_id = $('#business_country_id').find(":selected").val();
                var option = '';
                $('#business_region_id').prop('disabled', false);

                $.ajax({
                    method: "POST",
                    url: "{{route('getRegions')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        'country_id': country_id
                    },
                    success: function (response) {

                        $('#business_region_id').empty();
                        $('#business_region_id').append(' <option value="" selected disabled>Select Region</option>');

                        response.regions.forEach(function (item, index) {
                            option = "<option value='" + item.id + "'>" + item.name + "</option>"
                            $('#business_region_id').append(option);
                        });

                    }
                });
            });
            $('#business_region_id').on('change', function () {
                var state_id = $('#business_region_id').find(":selected").val();
                var option = '';
                $('#business_city_id').prop('disabled', false);
                $.ajax({
                    method: "POST",
                    url: "{{route('getCitiesByRegion')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        'state_id': state_id
                    },
                    success: function (response) {

                        $('#business_city_id').empty();
                        $('#business_city_id').append(' <option value="" selected disabled>Select City</option>');

                        response.cities.forEach(function (item, index) {
                            option = "<option value='" + item.id + "'>" + item.name + "</option>"
                            $('#business_city_id').append(option);
                        });

                    }
                });
            });
            //Delivery Country City States Function on change dropdown
            $('#delivery_country_id').on('change', function () {
                var country_id = $('#delivery_country_id').find(":selected").val();
                var option = '';
                $('#delivery_region_id').prop('disabled', false);

                $.ajax({
                    method: "POST",
                    url: "{{route('getRegions')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        'country_id': country_id
                    },
                    success: function (response) {

                        $('#delivery_region_id').empty();
                        $('#delivery_region_id').append(' <option value="" selected disabled>Select Region</option>');

                        response.regions.forEach(function (item, index) {
                            option = "<option value='" + item.id + "'>" + item.name + "</option>"
                            $('#delivery_region_id').append(option);
                        });

                    }
                });
            }); 
            $('#delivery_region_id').on('change', function () {
                var state_id = $('#delivery_region_id').find(":selected").val();
                var option = '';
                $('#delivery_city_id').prop('disabled', false);
                $.ajax({
                    method: "POST",
                    url: "{{route('getCitiesByRegion')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        'state_id': state_id
                    },
                    success: function (response) {

                        $('#delivery_city_id').empty();
                        $('#delivery_city_id').append(' <option value="" selected disabled>Select City</option>');

                        response.cities.forEach(function (item, index) {
                            option = "<option value='" + item.id + "'>" + item.name + "</option>"
                            $('#delivery_city_id').append(option);
                        });

                    }
                });
            });  
        });
    </script>
@endsection