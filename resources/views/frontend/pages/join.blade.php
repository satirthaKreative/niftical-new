@extends('frontend.app')
@section('content')
<div class="inner-ban">
    <img src="{{ asset('frontend/images/inner-ban.jpg') }}" alt="">
    <div class="ban text">
        <h2>Products</h2>
        <ul>
            <li><a href="{{ route('satirtha.home') }}">Home <i class="fas fa-chevron-right"></i></a></li>
            <li> Join Us</li>
        </ul>
    </div>
</div>

<section class="join-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 pr-lg-5">
                <h3>Login !!</h3>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
               <form action="{{ route('login') }}"  method="POST">
                   @csrf
                    <input type="text" placeholder="User Name" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <input type="password" placeholder="Password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <input type="submit" value="Log in">
               </form>
            </div>
            <div class="col-lg-6 col-md-6 pl-lg-5">
                <h3>Register Now</h3>
                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                <form  method="POST" action="{{ route('register') }}">
                    @csrf
                    <input type="text" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <input type="text" placeholder="Email"  name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <input type="password" placeholder="Password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <input type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
@endsection
@section('jsContent')

@endsection