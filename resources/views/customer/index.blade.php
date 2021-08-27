@extends('layouts.customer')

@section('content')
    <div class="container">
        <div>
            <div class="text-center">
                <h2 class="heading-wrapper">MANAGE YOUR ACCOUNT</h2>
            </div>
            <div>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header text-right card-header-custm" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link color-dark" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body p-0">
                                @if($customerDetail == null)
                                    <form id="customer-detail-info-form" method="POST"> @csrf   
                                @else
                                    <form id="customer-detail-info-form-update" method="POST">@csrf 
                                        @method('PUT')
                                @endif
                                    <div class="form-container" style="height: 715px;">
                                        <div class="row">
                                            <div class="col-lg-6 border-riht-clr">
                                                <div>
                                                    <h2 class="heading-inner-top">Business Details</h2>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_name">Business Name <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_name') is-invalid @enderror" id="business_name" name="business_name"
                                                        value="@if($customerDetail == null){{old('business_name')}} @else {{$customerDetail->business_name}} @endif" placeholder="Enter Business Name" required>
                                                        @error('business_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_address_1') is-invalid @enderror" id="business_address_1" name="business_address_1"
                                                        value="@if($customerDetail == null){{old('business_address_1')}} @else {{$customerDetail->business_address_1}} @endif" placeholder="Enter Business Address 1 etc." required>
                                                        @error('business_address_1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('business_address_2') is-invalid @enderror" id="business_address_2" name="business_address_2"
                                                        value="@if($customerDetail == null){{old('business_address_2')}} @else {{$customerDetail->business_address_2}} @endif" placeholder="Enter Business Address 2 etc.">
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
                                                            <option value="1" {{ isset($customerDetail->business_country_id) &&$customerDetail->business_country_id == 1?'selected':''}}>Pakistan</option>
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
                                                            <option value="2"  {{ isset($customerDetail->business_region_id) && $customerDetail->business_region_id == 2?'selected':''}}>Punjab</option>
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
                                                            <option value="3"  {{ isset($customerDetail->business_city_id) && $customerDetail->business_city_id == 3 ?'selected':''}}>Lahore</option>
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
                                                        placeholder="Enter Phone No" value="@if($customerDetail == null){{old('business_phone_no')}} @else {{$customerDetail->business_phone_no}} @endif">
                                                        @error('business_phone_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_email">Email <span class="required-star">*</span></label>
                                                        <input type="email" class="form-control @error('business_email') is-invalid @enderror" id="business_email" name="business_email"
                                                        value="@if($customerDetail == null){{old('business_email')}} @else {{$customerDetail->business_email}} @endif" placeholder="Enter Business Email" required>
                                                        @error('business_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_contact_no">Contact No  <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_contact_no') is-invalid @enderror" id="business_contact_no" name="business_contact_no"
                                                            value="@if($customerDetail == null){{old('business_contact_no')}} @else {{$customerDetail->business_contact_no}} @endif"  placeholder="Enter Business Contact No" required>
                                                        @error('business_contact_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <h2 class="heading-inner-top">Delivery Details</h2>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_name">Delivery Name <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control  @error('delivery_name') is-invalid @enderror" id="delivery_name" name="delivery_name"
                                                            value="@if($customerDetail == null){{old('delivery_name')}} @else {{$customerDetail->delivery_name}} @endif" placeholder="Enter Delivery Name" required>
                                                        @error('delivery_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('delivery_address_1') is-invalid @enderror" id="delivery_address_1" name="delivery_address_1"
                                                            value="@if($customerDetail == null){{old('delivery_address_1')}} @else {{$customerDetail->delivery_address_1}} @endif" placeholder="Enter Delivery Address 1" required>
                                                        @error('delivery_address_1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('delivery_address_2') is-invalid @enderror" id="delivery_address_2" name="delivery_address_2"  value="@if($customerDetail == null){{old('delivery_address_2')}} @else {{$customerDetail->delivery_address_2}} @endif"
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
                                                            <option value="1" {{ isset($customerDetail->delivery_country_id) && $customerDetail->delivery_country_id == 1 ?'selected':''}}>Pakistan</option>
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
                                                            <option value="2" {{ isset($customerDetail->delivery_region_id) && $customerDetail->delivery_region_id == 2 ?'selected':''}}>Punjab</option>
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
                                                            <option value="3" {{ isset($customerDetail->delivery_city_id) && $customerDetail->delivery_city_id == 3 ?'selected':''}}>Lahore</option>
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
                                                            <a href="#" class="view-mdl-wrapper" data-toggle="modal"
                                                            data-target="#exampleModalCenter">view</a>
                                                        </div>
                                                        <div class="form-inner-section">
                                                            <a href="#" style="visibility: hidden;">view</a>
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
                                                    <textarea class="form-control" id="delivery_notes" name="delivery_notes" rows="3">@if($customerDetail == null){{old('delivery_notes')}}@else{{$customerDetail->delivery_notes}}@endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="user_id" value="{{$user}}" id="user_id">
                                        <div style="float: right" id="button">
                                            @if($customerDetail == null)
                                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                            @else
                                                <button type="submit" id="update" class="btn btn-primary" data-id="{{ $user }}">Update</button>
                                            @endif
                                        </div>
                                    </div>
                                    @include('customer.modal')
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
                        @foreach ($products as $product)
                            <tr>
                                <td class="table-td-wrapper" scope="row">{{$product->name}}</td>
                                <td>
                                    <input id="monday-{{$product->id}}" class="monday" type="number" name="monday" style="width: 80px;
                                    text-align: center;" value="">
                                </td>
                                <td>
                                    <input id="tuesday-{{$product->id}}" class="tuesday" type="number" name="tuesday" style="width: 80px;
                                    text-align: center;">
                                </td>
                                <td>
                                    <input id="wednesday-{{$product->id}}" class="wednesday" type="number" name="wednesday" style="width: 80px;
                                    text-align: center;">
                                </td>
                                <td>
                                    <input id="thursday-{{$product->id}}" class="thursday" type="number" name="thursday" style="width: 80px;
                                    text-align: center;">
                                </td>
                                <td>
                                    <input id="friday-{{$product->id}}" class="friday" type="number" name="friday" style="width: 80px;
                                    text-align: center;">
                                </td>
                                <td>
                                    <input id="weekly-{{$product->id}}" class="weekly" type="number" style="width: 80px;
                                    text-align: center;" disabled>
                                </td>
                                <td>
                                    <input id="weekly-{{$product->id}}" class="weekly" type="number" style="width: 80px;
                                    text-align: center;" disabled>
                                </td>
                            </tr> 
                        @endforeach
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
@endsection 
@section('scripts')
    <!---- CUSTOMER FORM UPDATE AND STORE FUNCTION SCRIPT ----> 
    <script>
        $(document).ready(function(){
            /// Phone Number
            $('#business_contact_no').mask('0000-0000000');
            //Submit Form Function
            $("#customer-detail-info-form").on("submit", function(event){
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('customer-detail.store')}}',
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
                let id = $('#update').attr('data-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    data: formData,
                    url: 'home/customer-detail/'+id,
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
                    alert( "Form successful submitted!" );
                }
            });
            $('#customer-detail-info-form').validate({
                rules: {
                    business_name: {
                        required: true,
                        minlength: 6
                    },
                    business_address_1: {
                        required: true,
                        minlength: 6
                    },
                    business_address_2: {
                        required: true,
                        minlength: 6
                    },
                    business_country_id: {
                        required: true,
                    },
                    business_region_id: {
                        required: true,
                    },
                    business_city_id: {
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
                        minlength: 6
                    },
                    delivery_address_1: {
                        required: true,
                        minlength: 6
                    },
                    delivery_address_2: {
                        required: true,
                        minlength: 6
                    },
                    delivery_country_id: {
                        required: true,
                    },
                    delivery_region_id: {
                        required: true,
                    },
                    delivery_city_id: {
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
                    business_address_2: {
                        required: "Please enter a business address 2 123 etc.",
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
                    delivery_address_2: {
                        required: "Please enter a delivery address 2 123 etc.",
                        delivery_address_2: "Your delivery Name Must Be 6 characters"
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
                submitHandler: function () {
                    alert( "Form successful updated!" );
                }
            });
            $('#customer-detail-info-form-update').validate({
                rules: {
                    business_name: {
                        required: true,
                        minlength: 6
                    },
                    business_address_1: {
                        required: true,
                        minlength: 6
                    },
                    business_address_2: {
                        required: true,
                        minlength: 6
                    },
                    business_country_id: {
                        required: true,
                    },
                    business_region_id: {
                        required: true,
                    },
                    business_city_id: {
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
                        minlength: 6
                    },
                    delivery_address_1: {
                        required: true,
                        minlength: 6
                    },
                    delivery_address_2: {
                        required: true,
                        minlength: 6
                    },
                    delivery_country_id: {
                        required: true,
                    },
                    delivery_region_id: {
                        required: true,
                    },
                    delivery_city_id: {
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
                    business_address_2: {
                        required: "Please enter a business address 2 123 etc.",
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
                    delivery_address_2: {
                        required: "Please enter a delivery address 2 123 etc.",
                        delivery_address_2: "Your delivery Name Must Be 6 characters"
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