@extends('layouts.login')

@section('content')

<center>
    <div class="container my-5">
        <div class="login-container">
            <form method="POST" action="{{ route('login') }}" onsubmit="return validateRecaptcha()">
                @csrf
            <div class="logo-and-heading">
                <img src="photos/OSA LOGO.png" alt="" class="custom-image2">
                <h1>SOARS</h1><br>
            </div>
            <h2>Office of Student Affairs</h2>
            <form>
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="form-control @error('password') 
                    is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <div class="form-group">
                    @isset($_GET['credential'])
                        <h3 style="text-align: center; color: orangered">Your credentials is incorrect</h3>
                    @endisset
                </div>
                
                @if(session('login_attempts') >= 3)
                    <strong>Google reCAPTCHA:</strong>
                    @if ($errors->has('g-recaptcha-response'))
                    <center>
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('g-recaptcha-response') }}
                    </div>
                    </center>
                    @endif
                    <div class="form-group" style="margin-left: 30px; ">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    </div>
                @endif
                
                <button type="submit" id="loginButton">{{ __('Login')}}</button>
                
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <br>
                <img src="/photos/adulogo.png" alt="" class="custom-image">
                </div>
                
            </form>
            
        </div>
    </div>
</center>

<!-- Include reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function validateRecaptcha() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            // If reCAPTCHA not checked, prevent form submission
            alert('Please complete the reCAPTCHA.');
            return false;
        }
        return true;
    }
</script>


@endsection

