@extends('navbar.navbar_student_leader')
@section('content')

    
    
    <!-- Scripts -->
</head>
<body>

<!--Hamburger Menu-->



<main style="overflow-x: hidden;">

  <div class="container">
    

    <div class="container" style="padding-top: 8%;">
        <div class="row">

            <h1 style="padding-left: 30px; padding-top: 10px; padding-bottom: 30px;">
                <i class="fas fa-user-clock"></i> Actionsss
            </h1>
            <div class="col-md-3 mb-3">
                <a href="#" class="card" style="height: 130px; background-color: #E7700D; text-decoration: none;" onclick="openCreatePostModal()">
                    <h2 style="color: white;">Create an Announcement <i class="fa-solid fa-bullhorn"></i></h2>
                    
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="OSAmessages.html" class="card" style="height: 130px; background-color: #e57373; text-decoration: none;">
                    <h2 style="color: white;">Messages <i class="fa-regular fa-message"></i></h2>
                    <p style="font-size: 20px; color: white;">20</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="SLactivities.html" class="card" style="height: 130px; background-color: #81c784; text-decoration: none;">
                    <h2 style="color: white;">Activities <i class="fa-solid fa-chart-line"></i></h2>
                    <p style="font-size: 20px; color: white;">25</p>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="SLMemberApproval.html" class="card" style="height: 130px; background-color:#668DDA; text-decoration: none;">
                    <h2 style="color: white;">Member Approval <i class="fa-regular fa-address-card"></i></h2>
                    <p style="font-size: 20px; color: white;">20</p>
                </a>
            </div>
            
        </div>
    </div>

 
    <h1 style="padding-left:20px; padding-top: 3%; padding-bottom: 2.5%;">
        <i class="fas fa-bullhorn"></i> Announcements
    </h1>
        <div class="announcement" style="margin-bottom:5%;">
            <a href="#" class="announcement-link">
                <div class="announcement-header">
                    <h3 class="announcement-title">
                    <i class="fa-regular fa-clipboard"></i> Title:
                    </h3>
                <p class="announcement-date">Posted on January 25, 2024</p>
                
                <p class="author">Author</p>
                </div>
                <div class="announcement-body">
                    <p class="announcement-content">
                    Message
                    </p>
                </div>
            </a>
        </div>
    
         

         <h1 style="padding-left: 20px; padding-top: 40px; padding-bottom: 30px;">
             <i class="fas fa-users fa-lg"></i> Organizations
         </h1>
         <div class="card mb-3" style="max-width: 1100px; margin: auto; text-align: center;">
         <div class="row g-0">
         <div class="col-md-4">
             <img src="(AUBS).jpg" class="img-fluid rounded-start" alt="Profile Picture" style="padding-top: 37px;">
         </div>
         <div class="col-md-8" style="padding-right: 200px;">
             <div class="card-body">
                 <h3 class="card-title" style="font-size: 50px;">AUBS</h3>
                 <p class="card-text">Adamson University Biology Society</p>
                 <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                 <button class="btn btn-primary" onclick="window.location.href='AUBS.html'">Go to Page</button>
             </div>
         </div>
     </div>
 </div>
 
  </div>
         
 
 <!-- Create Post Modal -->
 <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
           <h5 class="modal-title" id="createPostModalLabel">Create an Announcement</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         
         <!-- Modal Body -->
         <div class="modal-body">
          <!-- Form to create post -->
 <form>
     <div class="form-group">
         <label for="postContent">Post Content</label>
         <textarea class="form-control" id="postContent" rows="3"></textarea>
     </div>
     
     <div class="form-group">
         <label for="userType">Send to</label>
         <select class="form-control" id="userType">
             <option value="student">Student</option>
             <option value="studentLeader">Student Leader</option>
             <option value="All">All</option>
         </select>
     </div>
 </form>
         
         <!-- Modal Footer -->
         <div class="modal-footer">
           <!-- Close button -->
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <!-- Post button -->
           <button type="button" class="btn btn-primary" id="postButton">Post</button>
         </div>
       </div>
     </div>
   </div>
 
     </main>
 
 <!-- Add Bootstrap JavaScript (optional) -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <script>
     function redirectToMemberDash() {
         window.location.href = "Memberdash.html";
     }
 </script>
 
 <script>
     // JavaScript for handling post creation
 document.getElementById('postButton').addEventListener('click', function() {
 // Get post content
 var postContent = document.getElementById('postContent').value;
 
 // Get uploaded image (if any)
 var postImage = document.getElementById('postImage').files[0];
 
 // Here you can perform further processing like sending data to server or displaying the post
 console.log('Post Content:', postContent);
 console.log('Post Image:', postImage);
 
 // Clear form fields
 document.getElementById('postContent').value = '';
 document.getElementById('postImage').value = '';
 
 // Close modal
 $('#createPostModal').modal('hide');
 });
 </script>
 <script>
     function openCreatePostModal() {
         $('#createPostModal').modal('show');
     }
 </script>
 </body>
 </html>
 
@endsection
