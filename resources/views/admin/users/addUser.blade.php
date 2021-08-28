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
                    <h1>User's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('user.index')}}" class="btn btn-dark">Back</a>
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
                        <form action="{{route('user.store')}}" id="registrationForm" method="POST">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="firstName" name="name"
                                            placeholder="Enter Name"  value="{{old('name')}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Email <span class="required-star">*</span></label>
                                        <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" id="emailAddress" 
                                        placeholder="Enter Email" value="{{old('email')}}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Role's <span class="required-star">*</span></label>
                                        <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                            <option selected disabled>Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Password <span class="required-star">*</span></label>
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="Enter Password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Confirm Password <span class="required-star">*</span></label>
                                        <input id="password_confirm" type="password" class="form-control"
                                            placeholder="Confirm Your Password" name="password_confirmation">
                                        @error('password_confirmation')
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
       
       document.getElementById("registrationForm").onsubmit=function(e){
            firstNameValidation();
            // lastNameValidation();
            emailAddressValidation();
            // mobileNumberValidation();
            passwordValidation();
            confirmPasswordValidation();

            if(firstNameValidation()==true && 
            emailAddressValidation() == true && 
            passwordValidation()==true && 
            confirmPasswordValidation()==true){    
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{route('user.store')}}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        console.log(response);
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
                        else
                        {
                            alert(response.error);
                        }
                    },
                }); 
            
            }
}    
       //  Name Validation
        var firstName= document.getElementById("firstName");

        var firstNameValidation=function(){

        firstNameValue=firstName.value.trim(); 
        validFirstName=/^[A-Za-z]+$/;
        firstNameErr=document.getElementById('first-name-err');

        if(firstNameValue=="")
        {
            firstNameErr.innerHTML="name is required";

        }else if(!validFirstName.test(firstNameValue)){
            firstNameErr.innerHTML="name must be string";
        }else{
            firstNameErr.innerHTML="";
            return true;
            
        }
        }

        firstName.oninput=function(){
        
        firstNameValidation();
        } 

        // Email Address Validation
 var emailAddress= document.getElementById("emailAddress");
 var emailAddressValidation= function(){

  emailAddressValue=emailAddress.value.trim(); 
   validEmailAddress=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   emailAddressErr=document.getElementById('email-err');

   if(emailAddressValue=="")
   {
    emailAddressErr.innerHTML="Email Address is required";

   }else if(!validEmailAddress.test(emailAddressValue)){
     emailAddressErr.innerHTML="Email Address must be in valid formate with @ symbol";
   }else{
     emailAddressErr.innerHTML="";
     return true;
   }

 }

emailAddress.oninput=function(){
    var startTimer;
    let email = $(this).val();
    startTimer = setTimeout(checkEmail, 500, email);
   emailAddressValidation();
}


        function checkEmail(email) {
            emailAddressErr=document.getElementById('email-err');
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
                            emailAddressErr.innerHTML=data.message[0];
                            // $('#email').after('<div id="email-err" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                        } else {
                            emailAddressErr.innerHTML=data.message;
                            // $('#email').after('<div id="email-err" class="text-success" <strong>'+data.message+'<strong></div>');
                        }

                    }
                });
            } else {
                $('#email').after('<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
            }
        }



// Password Validation
var password= document.getElementById("password");;

var passwordValidation = function(){

  passwordValue=password.value.trim(); 
   validPassword=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
   
   passwordErr=document.getElementById('password-err');

   if(passwordValue=="")
   {
    passwordErr.innerHTML="Password is required";
   }else if(!validPassword.test(passwordValue)){
     passwordErr.innerHTML="Password must have at least one Uppercase, lowercase, digit, special characters & 8 characters";
   }
   else{
     passwordErr.innerHTML="";
     return true;
   }
}

password.oninput=function(){

   passwordValidation();

 confirmPasswordValidation();
   
}

// Confirm Password Validation
var confirmPassword= document.getElementById("confirmPassword");;

var confirmPasswordValidation=function(){
   confirmPasswordValue=confirmPassword.value.trim(); 
   
   confirmPasswordErr=document.getElementById('confirm-password-err');
   if(confirmPasswordValue==""){
       confirmPasswordErr.innerHTML="Confirm Password is required";
   }

  else if(confirmPasswordValue!=password.value){
     confirmPasswordErr.innerHTML="Confirm Password does not match";
   }
   else{
     confirmPasswordErr.innerHTML="";
     return true;
   }
}

confirmPassword.oninput=function(){

 confirmPasswordValidation();
   
}
    </script>
@endsection