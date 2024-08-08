@extends('layouts.login')

@section('content')


<center>
    <div class="container my-5">
        <div class="login-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="logo-and-heading">
                <img src="photos/OSA LOGO.png" alt="" class="custom-image2">
                <h1>SOARS</h1><br>
            </div>
            <h2>Office for Student Affairs</h2>
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
                    @isset($_GET['timeout'])
                        <h3 style="text-align: center; color: orangered">You've been Logged out.</h3>
                    @endisset
                </div>
                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember" style="width:10%;" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" for="remember" style="display: inline;">{{__('Remember Me')}}</label>
                </div>
                
                <div class="form-group">
                    <div style="display: flex; align-items: center;">
                        <input type="checkbox" id="termsCheckbox" style="width:10%;" required>
                        <label for="termsCheckbox" style="margin-left: 5px;">I agree to the <a href="#" id="termsLink">data privacy terms & agreement</a></label>
                    </div>
                </div>
    
                <div>
                
                
                
                <button type="submit" id="loginButton">{{ __('Login')}}</button>
            </form>
            <img src="/photos/adulogo.png" alt="" class="custom-image">
        </div>
    </div>

  <!-- Modal -->
<div class="modal" id="termsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Data Privacy Terms & Agreement</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            <p>
                                    By clicking "I agree", you acknowledge and agree to the following data privacy terms:
                                </p>
                        
                                <h3>1. Collection of Personal Information</h3>
                                <p>
                                    We may collect and process personal information, including but not limited to your name, email address, and other relevant details.
                                </p>
                        
                                <h3>2. Use of Personal Information</h3>
                                <p>
                                    Your personal information may be used for purposes such as account management, communication, and service improvement.
                                </p>
                        
                                <h3>3. Data Security</h3>
                                <p>
                                    We implement reasonable security measures to protect your personal information from unauthorized access or disclosure.
                                </p>
                        
                                <h3>4. Sharing of Information</h3>
                                <p>
                                    Your personal information may be shared with third parties only for legitimate business purposes or as required by law.
                                </p>
                        
                                <h3>5. Your Rights</h3>
                                <p>
                                    You have the right to access, correct, or delete your personal information. Contact us for assistance.
                                </p>
                        
                                <h3>6. Changes to Privacy Policy</h3>
                                <p>
                                    We reserve the right to update our data privacy terms. Any changes will be communicated to you through appropriate channels.
                                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="width: auto;">I agree</button>
            </div>
        </div>
    </div>
</div>
</center>



<script>
    document.getElementById('termsLink').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('termsModal').style.display = 'block';
    });

    // Hide the modal when clicking outside of it or clicking the close button
    window.addEventListener('click', function(event) {
        var modal = document.getElementById('termsModal');
        if (event.target == modal || event.target.getAttribute('data-dismiss') === 'modal') {
            modal.style.display = 'none';
        }
    });
</script>



<!--<script>
    document.getElementById('loginButton').addEventListener('click', function (event) {
        event.preventDefault(); 

        
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        if (email.trim() === '' || password.trim() === '') {
            alert('Please enter both email and password.'); 
            return;
        }

        
        redirectToTermsAndAgreement();
    });

    function redirectToTermsAndAgreement() {
        window.location.href = "{{ route('terms_and_agreement') }}"; 
    }
</script>-->

@endsection

