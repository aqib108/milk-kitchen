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
                                        <input type="text"  class="form-control @error('phone') is-invalid @enderror" name="phone"  maxlength="12"
                                            value="{{$distributor->phone}}" placeholder="Enter Phone Number" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label class="label-wrapper-custm" for="country_id">Suburb <span class="required-star">*</span>
                                        </label>
                                        <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                            <option value="" selected disabled>Select Country</option>
                                            @foreach ($countries as $country)
                                            <option @if ($country->id == $distributor->country_id) selected @endif
                                                value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label class="label-wrapper-custm" for="region_id">Region <span class="required-star">*</span></label>
                                        <select name="region_id" id="region_id" class="form-control  @error('region_id') is-invalid @enderror">
                                            <option value="" selected disabled> Select State</option>
                                            @foreach ($states->where('country_id',$distributor->country_id) as $state)
                                                <option @if ($state->id == $distributor->region_id) selected @endif
                                                    value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('region_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label class="label-wrapper-custm" for="city_id">City <span class="required-star">*</span></label>
                                        <select name="city_id" id="city_id" class="form-control  @error('city_id') is-invalid @enderror">
                                            <option value="" selected disabled> Select City</option>
                                            @foreach ($cities->where('state_id',$distributor->region_id) as $city)
                                                <option @if ($city->id == $distributor->city_id) selected @endif
                                                    value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
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
        // GET STATES FOR SELECTED COUNTRY
        $('#country_id').on('change', function () {
            var country_id = $('#country_id').find(":selected").val();
            var option = '';
            $('#region_id').prop('disabled', false);

            $.ajax({
                method: "POST",
                url: "{{route('getRegions')}}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'country_id': country_id
                },
                success: function (response) {

                    $('#region_id').empty();
                    $('#region_id').append(' <option value="" selected disabled>Select Region</option>');

                    response.regions.forEach(function (item, index) {
                        option = "<option value='" + item.id + "'>" + item.name + "</option>"
                        $('#region_id').append(option);
                    });

                }
            });
        });
        // GET STATES FOR SELECTED COUNTRY
        $('#region_id').on('change', function () {
            var state_id = $('#region_id').find(":selected").val();
            var option = '';
            $('#city_id').prop('disabled', false);

            $.ajax({
                method: "POST",
                url: "{{route('getCitiesByRegion')}}",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    'state_id': state_id
                },
                success: function (response) {

                    $('#city_id').empty();
                    $('#city_id').append(' <option value="" selected disabled>Select City</option>');

                    response.cities.forEach(function (item, index) {
                        option = "<option value='" + item.id + "'>" + item.name + "</option>"
                        $('#city_id').append(option);
                    });

                }
            });
        });
    </script>
@endsection