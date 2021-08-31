@extends('admin.layouts.admin')
@section('page_title')
Add Product
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Driver's</h1>
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
                        <h3 class="card-title">Add Driver</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  id="registrationForm" >
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Name <span class="required-star">*</span></label>
                                    <input type="text" maxlength="50" class="form-control" name="name" id="name" placeholder="Enter Product Name">
                                    <div id="first-name-err" class="alert alert-danger"></div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Email <span class="required-star">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email"  placeholder="Enter Email Number">
                                    <div class="alert alert-danger" id="email-err" class="alert alert-danger"></div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label>Phone <span class="required-star">*</span></label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="mobileNumber" maxlength="17"  placeholder="Enter Phone Number" >
                                    <div class="alert alert-danger" id="mobile-number-err"></div>
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="label-wrapper-custm" for="country_id">Suburb <span class="required-star">*</span></label>
                                    <select name="area_id" class="form-control @error('area_id') is-invalid @enderror" id="area_id">
                                        <option selected disabled>Select Area</option>
                                        <option value="1">Pakistan</option>
                                    </select>
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                    <label class="label-wrapper-custm" for="region_id">Route <span class="required-star">*</span></label>
                                    <select name="route_id" class="form-control @error('route_id') is-invalid @enderror" id="route_id">
                                        <option selected disabled>Select Route</option>
                                        <option value="2">Punjab</option>
                                    </select>
                                    @error('route_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
        event.preventDefault();
        firstNameValidation();
        emailAddressValidation();
        mobileNumberValidation();
        if (firstNameValidation() == true && mobileNumberValidation() == true && emailAddressValidation() == true)
            {   
             
                event.preventDefault();
                var formData = new FormData(this);
               
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: "{{route('driver.store')}}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                       
                        if(response.status == "success")
                        {
                            $('#submit').hide();
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                            setTimeout(function () {
                                $(".alert-success").fadeOut("slow");
                                window.location.href="{{ route('driver.index') }}";
                            }, 2000);
                        }
                    },
                }); 
            }
            else{
                return false;
            }

            
}    
    //  Name Validation
    var firstName = document.getElementById("name");

    var firstNameValidation = function() {

        firstNameValue = firstName.value.trim();
        validFirstName = /^[A-Za-z]+$/;
        firstNameErr = document.getElementById('first-name-err');
        if (firstNameValue == "") {
            firstNameErr.innerHTML = "name is required";

        }  else if (!validFirstName.test(firstNameValue)) {
            firstNameErr.innerHTML = "name must be string";
        }
         else {
            firstNameErr.innerHTML = "";
            return true;

        }
    }

    firstName.oninput = function() {

        firstNameValidation();
    }

    // Mobile Number Validation
    var mobileNumber = document.getElementById("mobileNumber");

    var mobileNumberValidation = function() {

        mobileNumberValue = mobileNumber.value.trim();
        validMobileNumber = /^[0-9]*$/;
        mobileNumberErr = document.getElementById('mobile-number-err');

        if (mobileNumberValue == "") {
            mobileNumberErr.innerHTML = "Mobile Number is required";

        }
        else if(mobileNumberValue.length<=10 || mobileNumberValue.length>=17){
            mobileNumberErr.innerHTML="Mobile Number must have 10 to 17 digits";
            }

        else {
        mobileNumberErr.innerHTML = "";
        return true;
    }

    }
    mobileNumber.oninput = function() {

        mobileNumberValidation();
    }

    // Email Address Validation
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
    var emailAddress = document.getElementById("email");

    emailAddress.oninput = function() {
        emailAddressValidation();
        var startTimer;
        let email = $(this).val();
        startTimer = setTimeout(checkEmail, 500, email);     
    }

    function checkEmail(email) {
        emailAddressErr = document.getElementById('email-err');
        $('#email-error').remove();
        if (email.length > 1) {
            $.ajax({
                type: 'post',
                url: "{{ route('driver.checkEmail') }}",
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
        }
    }
</script>
@endsection