@extends('admin.layouts.admin')
@section('page_title')
    Add New User
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New User</h1>
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
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50" class="form-control" id="firstName" name="name"
                                            value="{{ old('name') }}" placeholder="Enter Product Name">
                                        <div id="first-name-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="email" maxlength="50" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder="Enter User Email" id="emailAddress">
                                        <div id="email-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50" class="form-control" id="password"
                                            name="password" placeholder="Enter Password">
                                        <div id="password-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Confirm Password <span class="required-star">*</span></label>
                                        <input type="password" maxlength="50" class="form-control"
                                            name="password_confirmation" id="confirmPassword"
                                            placeholder="Enter Again Password... ">
                                        <div id="confirm-password-err" class="alert alert-danger"></div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Role's <span class="required-star">*</span></label>
                                        <select name="role" class="form-control" id="">
                                            @foreach ($roles as $roll)
                                                <option value="{{ $roll->name }}" selected="{{ old('roll->name') }}">
                                                    {{ $roll->name }}</option>
                                            @endforeach
                                        </select>
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
                    url: '{{ route('user.store') }}',
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

            }
        }
        //  Name Validation
        var firstName = document.getElementById("firstName");

        var firstNameValidation = function() {

            firstNameValue = firstName.value.trim();
            validFirstName = /^[A-Za-z]+$/;
            firstNameErr = document.getElementById('first-name-err');

            if (firstNameValue == "") {
                firstNameErr.innerHTML = "name is required";

            } else if (!validFirstName.test(firstNameValue)) {
                firstNameErr.innerHTML = "name must be string";
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
                $('#email').after(
                    '<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
            }
        }



        // Password Validation
        var password = document.getElementById("password");;

        var passwordValidation = function() {

            passwordValue = password.value.trim();
            validPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/

            passwordErr = document.getElementById('password-err');

            if (passwordValue == "") {
                passwordErr.innerHTML = "Password is required";
            } else if (!validPassword.test(passwordValue)) {
                passwordErr.innerHTML =
                    "Password must contain at least 8 Characters, including Uppercase, lowercase, numbers and special characters";
            } else {
                passwordErr.innerHTML = "";
                return true;
            }
        }

        password.oninput = function() {

            passwordValidation();

            confirmPasswordValidation();

        }

        // Confirm Password Validation
        var confirmPassword = document.getElementById("confirmPassword");;

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
    </script>
@endsection
