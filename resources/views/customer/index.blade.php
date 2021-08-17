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
                                <form action="" method="POST">
                                    @csrf
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
                                                            placeholder="Enter Business Name" required>
                                                        @error('business_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('business_address_1') is-invalid @enderror" id="business_address_1" name="business_address_1"
                                                            placeholder="Enter Business Address 1 etc." required>
                                                        @error('business_address_1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('business_address_2') is-invalid @enderror" id="business_address_2" name="business_address_2"
                                                            placeholder="Enter Business Address 2 etc." required>
                                                        @error('business_address_2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_country_id">Suburb <span class="required-star">*</span></label>
                                                        <select name="business_country_id" class="form-control @error('business_country_id') is-invalid @enderror" id="business_country_id" required>
                                                            <option selected disabled>Select Country</option>
                                                        </select>
                                                        @error('business_country_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_region_id">Region <span class="required-star">*</span></label>
                                                        <select name="business_region_id" class="form-control @error('business_region_id') is-invalid @enderror" id="business_region_id" required>
                                                            <option selected disabled>Select Region</option>
                                                        </select>
                                                        @error('business_region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_city_id">City <span class="required-star">*</span></label>
                                                        <select name="business_city_id" class="form-control @error('business_city_id') is-invalid @enderror" id="business_city_id" required>
                                                            <option selected disabled>Select City</option>
                                                        </select>
                                                        @error('business_city_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_phone_no">Phone No</label>
                                                        <input type="number" class="form-control @error('business_phone_no') is-invalid @enderror" id="business_phone_no" name="business_phone_no" placeholder="Enter Phone No">
                                                        @error('business_phone_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_email">Email <span class="required-star">*</span></label>
                                                        <input type="email" class="form-control @error('business_email') is-invalid @enderror" id="business_email" name="business_email" placeholder="Enter Business Email" required>
                                                        @error('business_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="business_contact_no">Contact No  <span class="required-star">*</span></label>
                                                        <input type="number" class="form-control @error('business_contact_no') is-invalid @enderror" id="business_contact_no" name="business_contact_no" placeholder="Enter Business Contact No" required>
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
                                                            placeholder="Enter Delivery Name" required>
                                                        @error('delivery_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_1">Address 1 <span class="required-star">*</span></label>
                                                        <input type="text" class="form-control @error('delivery_address_1') is-invalid @enderror" id="delivery_address_1" name="delivery_address_1"
                                                            placeholder="Enter Delivery Address 1" required>
                                                        @error('delivery_address_1')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_address_2">Address 2 </label>
                                                        <input type="text" class="form-control @error('delivery_address_2') is-invalid @enderror" id="delivery_address_2" name="delivery_address_2" placeholder="Enter Delivery Address 2">
                                                        @error('delivery_address_2')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_country_id">Suburb <span class="required-star">*</span></label>
                                                        <select name="delivery_country_id" class="form-control @error('delivery_country_id') is-invalid @enderror" id="delivery_country_id" required>
                                                            <option selected disabled>Select Country</option>
                                                        </select>
                                                        @error('delivery_country_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_region_id">Region <span class="required-star">*</span></label>
                                                        <select name="delivery_region_id" class="form-control @error('delivery_region_id') is-invalid @enderror" id="delivery_region_id" required>
                                                            <option selected disabled>Select Region</option>
                                                        </select>
                                                        @error('delivery_region_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="label-wrapper-custm" for="delivery_city_id">City <span class="required-star">*</span></label>
                                                        <select name="delivery_city_id" class="form-control @error('delivery_city_id') is-invalid @enderror" id="delivery_city_id" required>
                                                            <option selected disabled>Select City</option>
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
                                                    <textarea class="form-control" id="" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="float: right">
                                            <button type="submit" class="btn btn-primary">Save</button>
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
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 1</td>
                            <td>3</td>
                            <td>4</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td class="weekly"></td>
                            <td class="weekly"></td>
                        </tr>
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
                            <th class="table-th-wrapper" scope="col"></th>
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
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 3</td>
                            <td></td>
                            <td>6</td>
                            <td></td>
                            <td></td>
                            <td>4</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 4</td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>8</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 5</td>
                            <td>2</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>9</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 6</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>5</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 7</td>
                            <td></td>
                            <td>4</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>2</td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 8</td>
                            <td></td>
                            <td></td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 9</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>9</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td class="table-td-wrapper" scope="row">Product 10</dh>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>1</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 