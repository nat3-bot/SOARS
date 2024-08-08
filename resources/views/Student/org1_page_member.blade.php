@extends('navbar.navbar_student')
@section('content')

<main class="container mt-4" style="margin-right: 740px !important;">
    
        <div class="btn-group mb-4" role="group" aria-label="Basic example" style="margin-left:35px; margin-top:5%;">
            <button type="button" style="margin-left: 230px;" class="btn btn-primary" onclick="showMissionVision()">Mission and Vision</button>
            <button type="button" class="btn btn-primary" onclick="showAnnouncement()">Announcements</button>
            <button type="button" class="btn btn-primary" onclick="showListOfOfficers()">List of Officers</button>
            <button type="button" class="btn btn-primary" onclick="showContactUs()">Contact Us</button>
            <button type="button" class="btn btn-primary" onclick="showEvents()">Events</button>                      
        </div> <br>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
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
                                    <strong>{{$orgsByCourse->name}}({{$orgsByCourse->nickname}})</strong>
                                    
                                    
                                   
                                </p>
                                <img src="/storage/logo/{{$orgsByCourse->logo}}" alt="{{$orgsByCourse->logo}}" class="img-fluid mb-3">
                                <strong>Academic Course Based: {{$orgsByCourse->academic_course_based}}</strong><br><br>
                                    
                                <br>
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title">Vision and Mission</h4>
                                <p class="card-text">
                                    <strong>Vision {{$orgsByCourse->vision}}</strong><br><br>
                                    
                                    <br><br>
                                    <strong>Mission{{$orgsByCourse->mission}}</strong><br><br>
                                    
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
                                
                                <a href="#"" class="officer-name">{{$orgsByCourse->adviser_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->adviser_email}}" class="officer-email">{{$orgsByCourse->adviser_email}}</a>
                                <p class="officer-position">Adviser</p>
                                
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->ausg_rep_studno}}">{{$orgsByCourse->ausg_rep_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->ausg_rep_email}}" class="officer-email">{{$orgsByCourse->ausg_rep_email}}</a>
                                <p class="officer-position">AUSG Representative </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->president_studno}}">{{$orgsByCourse->president_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->president_email}}" class="officer-email">{{$orgsByCourse->president_email}}</a><br>
                                <p class="officer-position">President </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->vp_internal_studno}}">{{$orgsByCourse->vp_internal_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->vp_internal_email}}" class="officer-email">{{$orgsByCourse->vp_internal_email}}</a><br>
                                <p class="officer-position">Vice President for Internal Affairs </p>
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->vp_external_studno}}">{{$orgsByCourse->vp_external_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->vp_external_email}}" class="officer-email">{{$orgsByCourse->vp_external_email}}</a><br>
                                <p class="officer-position">Vice President for External Affairs</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->secretary_studno}}">{{$orgsByCourse->secretary_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->secretary_email}}" class="officer-email">{{$orgsByCourse->secretary_email}}</a><br>
                                <p class="officer-position">Secretary </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->treasurer_studno}}">{{$orgsByCourse->treasurer_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->treasurer_email}}" class="officer-email">{{$orgsByCourse->treasurer_email}}</a><br>
                                <p class="officer-position">Treasurer</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->auditor_studno}}">{{$orgsByCourse->auditor_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->auditor_email}}" class="officer-email">{{$orgsByCourse->auditor_email}}</a><br>
                                <p class="officer-position">Auditor</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$orgsByCourse->pro_studno}}">{{$orgsByCourse->pro_name}}</a><br>
                                <a href="mailto: {{$orgsByCourse->pro_email}}" class="officer-email">{{$orgsByCourse->pro_email}}</a><br>
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
                    Email: <a href=" mailto: {{$orgsByCourse->org_email}}">{{$orgsByCourse->org_email}}</a><br>
                    FB: <a href="{{$orgsByCourse->org_fb}}" target="_blank">{{$orgsByCourse->org_fb}}</a><br>

                    <H2 style="text-align: start;">Facebook Page:</H2><br>
                    <div id="fb-root">

                    </div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="z2ywPdxc"></script>
                    <div class="row mt-3">
                        <div class="fb-page" data-href="{{$orgsByCourse->org_fb}}" data-tabs="timeline" 
                        data-width="500" data-height="" data-small-header="true" data-adapt-container-width="false" 
                        data-hide-cover="true" data-show-facepile="true"><blockquote cite="{{$orgsByCourse->org_fb}}" 
                        class="fb-xfbml-parse-ignore"><a href="{{$orgsByCourse->org_fb}}">{{$orgsByCourse->name}}</a></blockquote></div>
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

            
            
            
        </main>
        </div>
    </div>            
</main>

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