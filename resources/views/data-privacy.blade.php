@extends('layouts.login')

@section('content')
<style>
    .checkbox-label {
        display: flex;
        align-items: center;
        font-size: 12px; /* Adjust font size as needed */
    }

    .checkbox-label input[type="checkbox"] {
        margin-right: 5px; /* Adjust margin as needed */
    }

    .scrollable-terms-text {
        max-height: 200px;
        overflow-y: auto;
        padding: 10px;
    }

    .terms-text {
        font-size: 14px; /* Adjust font size as needed */
    }
</style>
<title>Terms and policy</title>

<body>
    <center>
        <div class="container my-5">
            <div class="login-container">
                <div class="logo-and-heading">
                    <img src="OSA LOGO.png" alt="" class="custom-image2" style="padding-bottom: 20px;">
                    <h1>SOARS</h1><br><br>
                </div>
<div class="container">
                <!-- New container for terms, management, and checkbox -->
                <div class="terms-and-management-container">
                    <div class="scrollable-terms-text">
                        <div class="terms-text">
                            <h2 style="font-size: 18px;">Data Privacy Terms and Agreement</h2>
                            <div class="terms-text">
                                <h2>Data Privacy Terms and Agreement</h2>
                        
                                <p>
                                    By checking the box, you acknowledge and agree to the following data privacy terms:
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
                        
                                <p>
                                    For detailed information, please refer to our complete <a href="#link-to-full-privacy-policy">Privacy Policy</a>.
                                </p>
                            </div>
                        </div>
                    </div>

                            

                            <!-- Other content with adjusted font size -->
                            <!--<label for="termsCheckbox" class="checkbox-label" style="margin-top: 10%;">
                                
                                <input type="checkbox" id="termsCheckbox" required>
                                <label> I agree to the data privacy terms and agreement</label>
                            </label>
               
                <button type="button" id="Next" style="margin-bottom: 10px; margin-top: 15px;">Next</button>-->

                <img src="adulogo.png" alt="" class="custom-image">
            </div>
        </div>
    </div>
</div>
</div>

    </center>
    <script>
        document.getElementById('Next').addEventListener('click', function () {
            if (document.getElementById('termsCheckbox').checked) {
                redirectToSLregister();
            } else {
                alert('Please agree to the data privacy terms and agreement.'); // You can customize the alert message
            }
        });
    
        function redirectToSLregister() {
            window.location.href = 'SLregister.html';
        }
    </script>


@endsection