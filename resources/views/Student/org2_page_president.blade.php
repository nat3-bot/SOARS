@extends('navbar.navbar_student')
@section('content')
@if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<main class="container mt-4" style="margin-right: 740px !important;">

    <div class="success">

    </div>
    <div class="container" style="margin-left:7%; margin-top:8%;">
        <div class="row">
            <div class="col mb-3">
                <a href="#" class="card" style="height: 130px; background-color: #E7700D; text-decoration: none;" onclick="openCreatePostModal()">
                    <h2 style="color: white;"><i class="fa-solid fa-bullhorn"></i> Create an Announcement </h2>
                </a>
            </div>

            <div class="col mb-3">
                <a href="{{url('/chatify')}}" class="card" style="height: 130px; background-color: #e57373; text-decoration: none;">
                    <h2 style="color: white;"><i class="fa-regular fa-message"></i> Messages </h2>
                    
                </a>
            </div>
            <div class="col mb-3">
                <a href="{{url('/student/propose_activity')}}" class="card" style="height: 130px; background-color: #81c784; text-decoration: none;">
                    <h2 style="color: white;"><i class="fa-solid fa-chart-line"></i> Activities {{$totalEvent->count()}}</h2>
                    
                </a>
            </div>
            
            <div class="col mb-3">
                <a href="{{url('/student/member_list2')}}" class="card" style="height: 130px; background-color: #8b00d6; text-decoration: none;">
                    <h2 style="color: white;"><i class="fa-solid fa-users fa-lg"></i> Members {{$totalMember->count()}}</h2>
                    
                </a>
            </div>
        </div>
    </div>
    
        <div class="btn-group mb-4" role="group" aria-label="Basic example" style="margin-left:35px; margin-top:2%;">
            <button type="button" style="margin-left: 230px;" class="btn btn-primary" onclick="showMissionVision()">Mission and Vision</button>
            <button type="button" class="btn btn-primary" onclick="showAnnouncement()">Announcements</button>
            <button type="button" class="btn btn-primary" onclick="showListOfOfficers()">List of Officers</button>
            <button type="button" class="btn btn-primary" onclick="showContactUs()">Contact Us</button>
            <button type="button" class="btn btn-primary" onclick="showEvents()">Events</button>
            <button type="button" class="btn btn-primary" onclick="showMoreInfo()">More Info</button>            
            <a href="{{url('/president/organization_edit/'.$organization->id)}}" class="btn btn-primary">Edit Page</a>
            <a href="{{ route('members_request') }}" class="btn btn-primary">Applying Members</a>
        </div> <br>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                
                <!-- ... other content ... -->
                
                <div id="announcement" class="card mt-4" style="height: auto; text-align:left;">
                    <div class="container">
                        <h1 style="padding-left:20px; padding-top: 5%; padding-bottom: 2.5%;">
                            <i class="fas fa-bullhorn"></i> Announcements
                        </h1>
                        @if ($announcement1 != null)
                        @foreach ( $announcement1 as $announce )
                        <div class="announcement" style="margin-bottom:5%;">
                            
                                <div class="announcement-header">
                                    <h3 class="announcement-title">
                                        <i class="fa-regular fa-clipboard"></i> Title: {{$announce->title}}
                                    </h3>
                                    <p class="announcement-date">Posted on {{$announce->created_at}}</p>
                                    <p class="author">Author: {{$announce->author}}. {{$announce->author_org}}</p>
                                </div>
                                <div class="announcement-body">
                                    
                                    {{$announce->message}}
                                    
                                </div>
                                
                        </div>
                        @endforeach
                        @endif
                </div>
                
            
                </div>
                
                <div id="missionVisionContent" class="card mt-1" style="height: 500px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="card-text">
                                    <strong>{{$organization->name}}({{$organization->nickname}})</strong>
                                </p>
                                <img src="/storage/logo/{{$organization->logo}}" alt="{{$organization->logo}}" class="img-fluid mb-3">
                                <strong>Academic Course Based: {{$organization->academic_course_based}}</strong><br><br>
                                    
                                <br>
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title">Vision and Mission</h4>
                                <p class="card-text">
                                    <strong>Vision</strong><br><br>
                                    {{$organization->vision}}
                                    <br><br>
                                    <strong>Mission</strong><br><br>
                                    {{$organization->mission}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        
               <!-- ... rest of the content ... -->
               <div id="listOfOfficersContent" class="card mt-4" style="height: auto ;">
                <div class="card-body">
                    <h4 class="card-title">List of Officers</h4><br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <p class="officer-name">{{$organization->adviser_name}}</p>
                                <a href="mailto: {{$organization->adviser_email}}" class="officer-email">{{$organization->adviser_email}}</a>
                                <p class="officer-position">Adviser</p>
                                
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->ausg_rep_studno}}">{{$organization->ausg_rep_name}}</a><br>
                                <a href="mailto: {{$organization->ausg_rep_email}}" class="officer-email">{{$organization->ausg_rep_email}}</a><br>
                                <p class="officer-position">AUSG Representative </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->president_studno}}">{{$organization->president_name}}</a><br>
                                <a href="mailto: {{$organization->president_email}}" class="officer-email">{{$organization->president_email}}</a><br>
                                <p class="officer-position">President </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->vp_internal_studno}}">{{$organization->vp_internal_name}}</a><br>
                                <a href="mailto: {{$organization->vp_internal_email}}" class="officer-email">{{$organization->vp_internal_email}}</a><br>
                                <p class="officer-position">Vice President for Internal Affairs </p>
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->vp_external_studno}}">{{$organization->vp_external_name}}</a><br>
                                <a href="mailto: {{$organization->vp_external_email}}" class="officer-email">{{$organization->vp_external_email}}</a><br>
                                <p class="officer-position">Vice President for External Affairs</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->secretary_studno}}">{{$organization->secretary_name}}</a><br>
                                <a href="mailto: {{$organization->secretary_email}}" class="officer-email">{{$organization->secretary_email}}</a><br>
                                <p class="officer-position">Secretary </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->treasurer_studno}}">{{$organization->treasurer_name}}</a><br>
                                <a href="mailto: {{$organization->treasurer_email}}" class="officer-email">{{$organization->treasurer_email}}</a><br>
                                <p class="officer-position">Treasurer</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->auditor_studno}}">{{$organization->auditor_name}}</a><br>
                                <a href="mailto: {{$organization->auditor_email}}" class="officer-email">{{$organization->auditor_email}}</a><br>
                                <p class="officer-position">Auditor</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$organization->pro_studno}}">{{$organization->pro_name}}</a><br>
                                <a href="mailto: {{$organization->pro_email}}" class="officer-email">{{$organization->pro_email}}</a><br>
                                <p class="officer-position">PRO</p>
                                
                            </div>
                        </div>
                        <!-- Add more columns as needed -->
                    </div>
                </div>
            </div>

            <div id="ContactUs" class="card mt-4" style="height: auto;">
                <div class="card-body" style="text-align: start;">
                    <h4 class="card-title">Contact Us</h4>
                    For inquiries and further information, please feel free to contact us:<br>
                    Email: <a href=" mailto: {{$organization->org_email}}">{{$organization->org_email}}</a><br>
                    FB: <a href="{{$organization->org_fb}}" target="_blank">{{$organization->org_fb}}</a><br>

                    <H2 style="text-align: start;">Facebook Page:</H2><br>
                    <div id="fb-root">

                    </div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="z2ywPdxc"></script>
                    <div class="row mt-3">
                        <div class="fb-page" data-href="{{$organization->org_fb}}" data-tabs="timeline" 
                        data-width="500" data-height="" data-small-header="true" data-adapt-container-width="false" 
                        data-hide-cover="true" data-show-facepile="true"><blockquote cite="{{$organization->org_fb}}" 
                        class="fb-xfbml-parse-ignore"><a href="{{$organization->org_fb}}">{{$organization->name}}</a></blockquote></div>
                    </div>
                </div>
            </div>
            
            <div id="Events" class="card mt-4" style="height: auto;">
                <div class="card-body">
                    
                    <div class="container">
                        <h1>Calendar of Events</h1>
                        <div id='calendar' style="background-color: rgb(255, 255, 255); padding: 10px 10px 20px 10px; margin-bottom: 30px;"></div>
                    </div>
                </div>
            </div>
            
            
            <div id="MoreInfo" class="card mt-1" style="height: auto;">
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <center>
                            <!-- Details for Constitutional Bylaws -->
                            <h2 class="mb-3">Constitutional Bylaws</h2>
                            <iframe src="/storage/consti_and_bylaws/{{$organization->consti_and_byLaws}}" width="100%" height="600px"></iframe>
            
                            <!-- Details for Letter of Intent -->
                            <h2 class="mt-4 mb-3">Letter of Intent</h2>
                            <iframe name="letter_of_intent" src="/storage/letter_of_intent/{{$organization->letter_of_intent}}" width="100%" height="600px"></iframe>
            
                            <!-- Details for Adviser Endorsement -->
                            <h2 class="mt-4 mb-3">Adviser Endorsement</h2>
                            <iframe src="/storage/admin_endorsement/{{$organization->admin_endorsement}}" width="100%" height="600px"></iframe>
                            </center>
                        </div>
                        
                </div>
            </div>
        </main>
        </div>
    </div>            
</main>


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
        <form action="/student/announcement/create" method="post">
            @csrf
            <div class="modal-body">
            <!-- Form to create post -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <textarea id="title" name="title" class="form-control"  rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message">Post Content</label>
                        <textarea id="message" name="message" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="userType">Send to</label>
                        <select class="form-control" id="recipient" name="recipient">
                            <option value="{{$organization->name}}">{{$organization->name}}</option>
                        </select>
                    </div>
                
            
            <!-- Modal Footer -->
            <div class="modal-footer">
            <!-- Close button -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- Post button -->
            <input type="submit" class="btn btn-primary" id="postButton"></input>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap CSS -->


<!-- JavaScript to handle modal buttons -->
<script>
    $(document).ready(function() {
        // Function to handle post button click
        $("#postButton").click(function() {
            // Your logic to handle post button click goes here
            // For example, you can fetch the post content and send it to the server
            // You can also close the modal after posting if needed
            $('#createPostModal').modal('hide'); // Close the modal
        });

        // Function to handle close button click
        $(".close, [data-dismiss='modal']").click(function() {
            // Close the modal when the close button is clicked
            $('#createPostModal').modal('hide');
        });
    });
</script>
<script>
    function openCreatePostModal() {
        $('#createPostModal').modal('show');
    }
</script>  



 <!-- Bootstrap JS and Popper.js -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <script>
     function showMissionVision() {
         document.getElementById('missionVisionContent').style.display = 'block';
         document.getElementById('announcement').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'none';
     }

     function showAnnouncement() {
        
        document.getElementById('missionVisionContent').style.display = 'none';
        document.getElementById('announcement').style.display = 'block';
        document.getElementById('listOfOfficersContent').style.display = 'none';
        document.getElementById('ContactUs').style.display = 'none';
        document.getElementById('Events').style.display = 'none';
        document.getElementById('MoreInfo').style.display = 'none';
     }

     function showListOfOfficers() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('announcement').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'block';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'none';
     }
     function showContactUs() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('announcement').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'block';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'none';
     }
     function showEvents() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('announcement').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'block';
         document.getElementById('MoreInfo').style.display = 'none';
     }
     function showMoreInfo() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('announcement').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'block';
     }

 </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
          center: 'title',
          right: 'prev,next today',
        },
        events: {
          url: '/student/dash', // Specify the URL to fetch events data from
          method: 'GET'
        }
        
      });
      calendar.render();
    });
  </script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  


          

     
     
 
 
 
 <!-- Add Bootstrap JavaScript (optional) -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->



@endsection