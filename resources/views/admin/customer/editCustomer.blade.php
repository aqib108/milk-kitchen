@extends('admin.layouts.admin')
@section('page_title')
    Edit Customer
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="btn btn-dark">Back</a>
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
                            <h3 class="card-title">Edit Customer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $customer->name }}" placeholder="Enter Product Name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="email" maxlength="50"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $customer->email }}" placeholder="Enter Email " required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50"
                                            class="form-control" name="password"  id="password"
                                            placeholder="Update Password " >
                                            <div id="password-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Debit Authority Number<span class="required-star">(Optional)</span></label>
                                        <input type="text"  class="form-control driver"  name="athority_number" minlength="4" maxlength="64"
                                         placeholder="Enter athority number" value="{{ $customer->athority_number ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Account Number<span class="required-star">(Optional)</span></label>
                                        <input type="text"  class="form-control driver"  name="account_number" minlength="4" maxlength="64"
                                         placeholder="Enter account number" value="{{ $customer->account_number ?? '' }}">
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                    <label> Assign Group<span class="required-star">*</span></label>
                                        <select class="form-control" name="groups[]" multiple style="width: 100%" required>
                                            @foreach ($groups as $value)   
                                            <option value="{{ $value->id }}" {{ in_array($value->id,$arr) ? 'selected' : false }}>
                                                {{ $value->group_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('groups')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                    {{-- <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Old Password</label>
                                        <input type="password" maxlength="50" class="form-control" name="old_password"
                                            placeholder="Enter Old Password">
                                        @error('old_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>New Password</label>
                                        <input type="password" maxlength="50" class="form-control" name="new_password"
                                            placeholder="Enter New Password">
                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
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

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                    $('#image').removeClass("hidden");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_url").change(function() {
            readURL(this);
        });

        // Get Input File Name
        $('.custom-file input').change(function(e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(','));
        });
    </script>
    <script>
    $(document).ready(function() {
        // Initialize Select2 select box
        $("select[name=\"validation-select2\"]").select2({
            allowClear: true,
            placeholder: "Select gear...",
        }).change(function() {
            $(this).valid();
        });
        // Initialize Select2 multiselect box
        $("select[name=\"groups[]\"]").select2({
            placeholder: "Select groups...",
        }).change(function() {
            $(this).valid();
        });
    });
</script>
@endsection
