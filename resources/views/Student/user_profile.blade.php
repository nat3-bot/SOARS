@extends('navbar.navbar_student')
@section('content')


<style>
    .custom-navbar {
        overflow-x: hidden;
    }
    body {
        margin: 0;
        padding: 0;
       
    }

    .floating-icon {
        position: fixed;
        bottom: 40px;
        right: 20px;
    }
    
 
    
.card-img-top {
max-width: 100%;
height: 200px;
object-fit: cover;
}

 #passwordMessage {
        color: red; /* Set text color to red */
        font-size: 80%; /* Reduce font size to 80% */
    }

    #confirmPasswordMessage {
        color: red; /* Set text color to red */
        font-size: 80%; /* Reduce font size to 80% */
    }
    .navbar-brand {
        display: flex;
        align-items: center;
    }
    .navbar-brand img {
        max-width: 50px;
        margin-right: 6px;
    }
    .navbar-brand h2 {
        margin: 0;
        color: white;
    }
    .navbar-brand h5 {
        margin: 0;
        color: white;
    }

</Style>



<main style="padding-top: 8%">
    <div class="container mt-1">
        <div class="row">
            <div class="success">
    
            </div>
            <div class="col-md-6 offset-md-3">
                
                    
                    <h2 class="text-center">User Profile Setup</h2>
                    <div class="form-group">
                        <label for="confirmPassword">Change Password:</label>
                        <a href="#" id="passwordLink">Click to enter your new password</a><br>
                        <p id="confirmPasswordMessage"></p> <!-- Paragraph to display message -->
                    </div>
                    
                    
                
            </div>
        </div>
    </div>
</main>
<form action="/student/update_pass" method="post">
    @csrf
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="password" class="form-control" id="password" placeholder="Enter your new password" onfocus="showPasswordRequirements()">
          <p id="passwordRequirements" style="color: red;"></p> <!-- Paragraph to display password requirements -->
        </div>
        <div class="modal-body">
            <input type="password" class="form-control" id="password" name="password" placeholder="Confirm Password" onfocus="showConfirmPasswordRequirements()">
            <p id="confirmPasswordRequirements" style="color: red;"></p> <!-- Paragraph to display confirm password requirements -->
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" onclick="submitPassword()">Submit</button>
          
        </div>
      </div>
    </div>
</div>
</form>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // Function to show password requirements below the first input field
    function showPasswordRequirements() {
        var passwordRequirements = "Password must be:<br>" +
            "- Between 8 - 30 characters<br>" +
            "- Contain at least one special character (~!@#$%^&*_-+=`|(){}[]:;\"'<>,.?/)<br>" +
            "- Contain at least one number (0-9)<br>" +
            "- Not match common profile fields";

        document.getElementById("passwordRequirements").innerHTML = passwordRequirements;
    }

    // Function to show confirm password requirements below the second input field
    function showConfirmPasswordRequirements() {
        var confirmPasswordRequirements = "Password must be the same as password";

        document.getElementById("confirmPasswordRequirements").innerText = confirmPasswordRequirements;
    }
</script>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Function to show the modal when password link is clicked
    document.getElementById("passwordLink").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior
        $('#passwordModal').modal('show'); // Show the modal
    });

    // Function to submit password
    function submitPassword() {
        var password = document.getElementById("passwordInput").value;
        // You can add further logic here, such as validation
        console.log("Password submitted: " + password);
        $('#passwordModal').modal('hide'); // Hide the modal after submitting password
    }
</script>

<script>
  function showEventModal(content) {
      // Set the HTML content in the modal body
      document.getElementById('eventDescriptionModalBody').innerHTML = content;

      // Show the modal
      $('#eventDescriptionModal').modal('show');
  }
</script>

<style>
    /* CSS for smaller text size */
    #passwordRequirements,
    #confirmPasswordRequirements {
        font-size: 14px; /* Adjust as needed */
    }
</style>

@endsection