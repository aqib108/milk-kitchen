@extends('layouts.auth')

@section('content')
    <section class="bg-wrapper-light">
        <div class="container">
            <div class="pb-bottom-space">
                <div class="text-center">
                    <h2 class="heading-one">FOOD SERVICE PORTAL</h2>
                </div>
                <div class="flex-wrapper-form margin--wrapper-70">
                    <div class="">
                
                        <div class="card card__custm__wrapper mt-3">
                            <div class="card-header card__header--wrapper"><h3 class="title-wrapper-three text-center">Register</h3>
                        
                            </div>
                            <div class="card-body Card__wrapper--innerbox">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    {{-- <div class="form-group input-group">
                                        <input class="form-control py-4 wrapper__input--border @error('first_name') is-invalid @enderror" id="first_name" type="text" name="first_name" placeholder="Enter First Name" required>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="images/Layer174.png" class="img-fluid" alt=""></span>
                                        </div>
                                    </div> --}}
                                    <div class="form-group input-group">
                                        <input class="form-control py-4 wrapper__input--border @error('name') is-invalid @enderror" id="name" name="name" type="text" placeholder="Enter Name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="{{asset('customer/images/Layer174.png')}}" class="img-fluid" alt=""></span>
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <input class="form-control py-4 wrapper__input--border  @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Enter Email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="{{asset('customer/images/Layer173.png')}}" class="img-fluid" alt="" style="height: 15px;"></span>
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <input class="form-control py-4 wrapper__input--border @error('password') is-invalid @enderror" id="inputPassword" name="password" type="password" placeholder="Enter Password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="{{asset('customer/images/Layer175.png')}}" class="img-fluid" alt=""></span>
                                        </div>
                                    </div>
                                    <div class="form-group input-group">
                                        <input class="form-control py-4 wrapper__input--border  @error('confirm_password') is-invalid @enderror" id="inputConfirmPassword" type="password" name="password_confirmation" placeholder="Enter Confirm Password" required>
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="{{asset('customer/images/Layer175.png')}}" class="img-fluid" alt=""></span>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                            <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                        </div>
                                    </div> -->
                                    <div class="form-group d-flex align-items-center justify-content-center  margin-top-three">
                                        <button class="btn btn__signin-wrapper" type="submit">submit</button>
                                    </div>
                                    <div class="text-center margin__top-wrapper3">
                                        <p class="account__title-wrapper"> <a class="register-wrapper" href="{{route('login')}}"> Login Here</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection