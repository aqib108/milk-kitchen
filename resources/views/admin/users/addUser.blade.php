@extends('admin.layouts.admin')
@section('page_title')
    Add New User
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-3">Add User</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New User</h5>
                    </div>
                    <div class="card-body">
                        <form  id="registrationForm" >
                            @csrf
                            <div class="row">
                                <div class="form-group  col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="firstName" name="name"
                                            placeholder="Enter User Name...">
                                            <div id="first-name-err" class="alert alert-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Email</label>
                                        <input type="text"  class="form-control" name="email" id="emailAddress" 
                                            placeholder="Enter User Email...">
                                            <div id="email-err" class="alert alert-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group  col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Enter User Password...">
                                            <div id="password-err" class="alert alert-danger"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" 
                                            placeholder="Enter password again...">
                                            <div id="confirm-password-err" class="alert alert-danger"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 error-placeholder">
                                        <label class="form-label">Role's</label>
                                        <select name="role" class="form-control" id="" >
                                            @foreach ($roles as $roll)
                                                <option value="{{ $roll->name }}"  selected="{{ old('roll->name') }}">{{ $roll->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="mb-3 error-placeholder">
                                    <label class="form-label">Select2 Multiple</label>
                                    <div class="d-flex">
                                        <select class="form-control" name="validation-select2-multi" multiple
                                            style="width: 100%">
                                            <option value="pitons">Pitons</option>
                                            <option value="cams">Cams</option>
                                            <option value="nuts">Nuts</option>
                                            <option value="bolts">Bolts</option>
                                            <option value="stoppers">Stoppers</option>
                                            <option value="sling">Sling</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 ">
                                    <div class="float-end">
                                        {{-- <button class="btn btn-primary">Back</button> --}}
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                window.location.href="{{ route('user.index') }}";
                            }, 2000);
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
