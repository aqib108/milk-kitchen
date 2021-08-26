@extends('admin.layouts.admin')
@section('title','Edit Distributor')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Distributor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('distributor.index')}}" class="btn btn-dark">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Distributor</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('distributor.update',[$distributor->id])}}" method="POST">
                            {{ csrf_field() }}
                           
                            <div class="card-body">
                            <div class="row">
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{$distributor->name}}" placeholder="Enter Product Name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="test"  class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{$distributor->email}}" placeholder="Enter Email Number" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Phone <span class="required-star">*</span></label>
                                        <input type="number"  class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{$distributor->phone}}" placeholder="Enter Phone Number" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label class="label-wrapper-custm" for="business_country_id">Suburb <span class="required-star">*</span></label>
                                            <select name="business_country_id" class="form-control @error('business_country_id') is-invalid @enderror" id="business_country_id">
                        
                                                <option value="1" selected>Pakistan</option>
                                            </select>
                                            @error('business_country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                         <label class="label-wrapper-custm" for="business_region_id">Region <span class="required-star">*</span></label>
                                        <select name="business_region_id" class="form-control @error('business_region_id') is-invalid @enderror" id="business_region_id">
        
                                            <option value="2" selected>Punjab</option>
                                        </select>
                                        @error('business_region_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label class="label-wrapper-custm" for="business_city_id">City <span class="required-star">*</span></label>
                                        <select name="business_city_id" class="form-control @error('business_city_id') is-invalid @enderror" id="business_city_id">
                                          
                                            <option value="3" selected>Lahore</option>
                                        </select>
                                        @error('business_city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').removeClass("hidden");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_url").change(function () {
            readURL(this);
        });

        // Get Input File Name
        $('.custom-file input').change(function (e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(','));
        });
    </script>
@endsection