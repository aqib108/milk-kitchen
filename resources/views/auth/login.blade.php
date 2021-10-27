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
                            <div class="card-header card__header--wrapper">
                                <h3 class="title-wrapper-three text-center">Login</h3>
                            </div>
                            <div class="card-body Card__wrapper--innerbox">
                            @if (session('message'))
                                    <div class="alert alert-danger">{{ session('message') }}</div>
                                @endif
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group input-group">
                                        <input class="form-control py-4 wrapper__input--border  @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="Enter Email" required autocomplete="email" autofocus>
                                     
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="{{asset('customer-panel/images/Layer173.png')}}" class="img-fluid" alt="" style="height: 15px;"></span>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group input-group">
                                        <input id="password" type="password" class="form-control py-4 wrapper__input--border  @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">
                                     
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent wrapper__label--border" id="basic-addon2"><img src="{{asset('customer-panel/images/Layer175.png')}}" class="img-fluid" alt=""></span>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-center  margin-top-three">
                                        <button class="btn btn__signin-wrapper" type="submit" >Submit</button>
                                    </div>
                                    <!-- @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="small forgot__label" href="{{route('password.request')}}">Recover Password?</a>
                                        </div>
                                    @endif -->
                                    <!-- <div class="text-center margin__top-wrapper3">
                                        <p class="account__title-wrapper"> <a class="register-wrapper" href="{{route('register')}}"> Register Here</a></p>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection