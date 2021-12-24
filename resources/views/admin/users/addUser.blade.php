@extends('admin.layouts.admin')
@section('page_title')
    Add User
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}" class="btn btn-dark">Back</a>
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
                            <h3 class="card-title">Add User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="registrationForm">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" id="firstName" name="name"
                                            value="{{ old('name') }}" placeholder="Enter User Name">
                                        <div id="first-name-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="email" maxlength="50" class="form-control" id="emailAddress"
                                            name="email" value="{{ old('email') }}" placeholder="Enter Email ">
                                        <div id="email-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" id>
                                        <label>Role's <span class="required-star">*</span></label>
                                        <select name="role" class="form-control" id="role_id">
                                            <option selected disabled>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden" id="assign_warehouse">
                                              
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden" id="assign_drivers">
                                              
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 hidden"  id="driver">
                                        <label>Driver Code<span class="required-star">*</span></label>
                                        <input type="text"  class="form-control driver"  name="driver_code" minlength="4" maxlength="4" placeholder="Enter 4-Digit Code Driver" value="{{ old('driver_code') }}">
                                        <div id="digit-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50" class="form-control" id="password"
                                            name="password" placeholder="Enter Password ">
                                        <div id="password-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Confirm Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50" class="form-control"
                                            name="password_confirmation" id="confirmPassword"
                                            placeholder="Enter Again Password... ">
                                        <div id="confirm-password-err" class="alert alert-danger"></div>
                                    </div>  
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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
        document.getElementById("registrationForm").onsubmit = function(e) {
            firstNameValidation();
            // lastNameValidation();
            emailAddressValidation();
            // mobileNumberValidation();
            passwordValidation();
            confirmPasswordValidation();

            if (firstNameValidation() == true &&
                emailAddressValidation() == true &&
                passwordValidation() == true &&
                confirmPasswordValidation() == true) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('user.store')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        if (response.status == "success") {
                            $('#submit').hide();
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                            setTimeout(function() {
                                $(".alert-success").fadeOut("slow");
                                window.location.href = "{{ route('user.index') }}";
                            }, 2000);
                        }

                    },
                });
            } else {
                return false;
            }
        }
        //  Name Validation
        var firstName = document.getElementById("firstName");
        var firstNameValidation = function() {
            firstNameValue = firstName.value.trim();
            // validFirstName = /^[A-Za-z]+$/;
            validFirstName = /^\w+$/;
            firstNameErr = document.getElementById('first-name-err');

            if (firstNameValue == "") {
                firstNameErr.innerHTML = "name is required";
            } else if (!validFirstName.test(firstNameValue)) {
                firstNameErr.innerHTML = " Username must contain only letters, numbers and underscores!";
            } else {
                firstNameErr.innerHTML = "";
                return true;
            }
        }
        firstName.oninput = function() {
            firstNameValidation();
        }
        // Email Address Validation
        var emailAddress = document.getElementById("emailAddress");
        var emailAddressValidation = function() {
            emailAddressValue = emailAddress.value.trim();
            validEmailAddress = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            emailAddressErr = document.getElementById('email-err');

            if (emailAddressValue == "") {
                emailAddressErr.innerHTML = "Email Address is required";
            } else if (!validEmailAddress.test(emailAddressValue)) {
                emailAddressErr.innerHTML = "Email Address must be in valid formate with @ symbol";
            } else {
                emailAddressErr.innerHTML = "";
                return true;
            }
        }
        emailAddress.oninput = function() {
            var startTimer;
            let email = $(this).val();
            startTimer = setTimeout(checkEmail, 500, email);
            emailAddressValidation();
        }
        function checkEmail(email) {
            emailAddressErr = document.getElementById('email-err');
            $('#email-error').remove();
            if (email.length > 1) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('user.checkEmail') }}",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success == false) {
                            emailAddressErr.innerHTML = data.message[0];
                            // $('#email').after('<div id="email-err" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                        } else {
                            emailAddressErr.innerHTML = data.message;
                            // $('#email').after('<div id="email-err" class="text-success" <strong>'+data.message+'<strong></div>');
                        }

                    }
                });
            } else {
                $('#email').after('<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
            }
        }
        // Password Validation
        var password = document.getElementById("password");
        var passwordValidation = function() {
            passwordValue = password.value.trim();
            re = /[0-9]/;  re1 = /[a-z]/;      re2 = /[A-Z]/;
            passwordErr = document.getElementById('password-err');

            if (passwordValue == "") {
                passwordErr.innerHTML = "Password is required";
            } 
            else if(!re.test(passwordValue)) {
            passwordErr.innerHTML="Error: password must contain at least one number (0-9)!";
            }
            else  if(!re1.test(passwordValue)) {
                passwordErr.innerHTML="Error: password must contain at least one lowercase letter (a-z)!";
                return false;
            }
            else  if(!re2.test(passwordValue)) {
                passwordErr.innerHTML="Error: password must contain at least one uppercase letter (A-Z)!";
                return false;
            }
            else {
                passwordErr.innerHTML = "";
                return true;
            }
        }
        password.oninput = function() {
            passwordValidation();
            confirmPasswordValidation();
        }
        // Confirm Password Validation
        var confirmPassword = document.getElementById("confirmPassword");
        var confirmPasswordValidation = function() {
            confirmPasswordValue = confirmPassword.value.trim();
            confirmPasswordErr = document.getElementById('confirm-password-err');

            if (confirmPasswordValue == "") {
                confirmPasswordErr.innerHTML = "Confirm Password is required";
            } else if (confirmPasswordValue != password.value) {
                confirmPasswordErr.innerHTML = "Confirm Password does not match";
            } else {
                confirmPasswordErr.innerHTML = "";
                return true;
            }
        }
        confirmPassword.oninput = function() {
            confirmPasswordValidation();
        }
        // Driver 4-Digit Code Assigined By Role OR Warehouse 
        $('#role_id').on('change', function() {
            var role_id = $('#role_id').find(":selected").val();
            // Driver Assigned WareHouse //
            if(role_id == 5)
            {
                $('#driver').removeClass('hidden');
                $.ajax({
                    method: "get",
                    url: "{{route('getWarehouses')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        role_id: role_id,
                    },
                    success: function(response) {
                        $('#assign_drivers').removeClass('hidden'); 
                        $('#assign_drivers').empty();
                        $('#assign_drivers').append(response.html);
                    }
                });
            }
            else
            {
                $('#driver').addClass('hidden');
                $('#assign_warehouse').addClass('hidden'); 
            }
            // WareHouse Manager Assigned Warehouse
            if(role_id == 4)
            {
                $.ajax({
                    method: "get",
                    url: "{{route('getWarehouses')}}",
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        role_id: role_id,
                    },
                    success: function(response) {
                        $('#assign_warehouse').removeClass('hidden'); 
                        $('#driver').addClass('hidden');
                        $('#assign_warehouse').empty();
                        $('#assign_warehouse').append(response.html);
                    }
                });
            }
            else
            {
                $('#assign_warehouse').empty();  
            }
        });
    </script> 
@endsection