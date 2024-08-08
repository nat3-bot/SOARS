@extends('navbar.admin_nav')
@section('content')


<main class="container mt-4" style="margin-right: 740px !important; padding-top: 80px;">
    
        <div class="btn-group mb-4" role="group" aria-label="Basic example" style="margin-left:35px;">
            <button type="button" style="margin-left: 230px;" class="btn btn-primary" onclick="showMissionVision()">Mission and Vision</button>
            <button type="button" class="btn btn-primary" onclick="showListOfOfficers()">List of Officers</button>
            <button type="button" class="btn btn-primary" onclick="showContactUs()">Contact Us</button>
            <button type="button" class="btn btn-primary" onclick="showEvents()">Events</button>
            <button type="button" class="btn btn-primary" onclick="showMoreInfo()">More Info</button>            
            <a href="{{url('/rso_list/rso_page/org_edit/'.$org->id)}}" style="text-align:end;" class="btn btn-primary">Edit Page</a>
            
            
        </div>
        <br>
        <form action="{{ route('org.delete', $org->id) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete Page</button>
        </form>        
        <br>

       

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-4">
                
                <!-- ... other content ... -->
        
                <div id="missionVisionContent" class="card mt-1" style="height: 500px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p class="card-text">
                                    <strong>{{$org->name}}({{$org->nickname}})</strong>
                                    
                                    
                                   
                                </p>
                                <img src="/storage/logo/{{$org->logo}}" alt="{{$org->logo}}" class="img-fluid mb-3">
                                <br>
                                <strong>Academic Course Based:</strong><br><br>
                                    {{$org->academic_course_based}}
                                <br>
                            </div>
                            <div class="col-md-8">
                                <h4 class="card-title">Vision and Mission</h4>
                                <p class="card-text">
                                    <strong>Vision</strong><br><br>
                                    {{$org->vision}}
                                    <br><br>
                                    <strong>Mission</strong><br><br>
                                    {{$org->mission}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        
               <!-- ... rest of the content ... -->
               <div id="listOfOfficersContent" class="card mt-4" style="height: auto ;">
                <div class="card-body">
                    <h4 class="card-title">List of Officers</h4><br>
                    <a class="btn btn-primary" href="/edit_officers/admin/{{$org->id}}">Manage Officers</a>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <p class="officer-name">{{$org->adviser_name}}</p>
                                <a href="mailto: {{$org->adviser_email}}" class="officer-email">{{$org->adviser_email}}</a>
                                <p class="officer-position">Adviser</p>
                                
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->ausg_rep_studno}}">{{$org->ausg_rep_name}}</a><br>
                                <a href="mailto: {{$org->ausg_rep_email}}" class="officer-email">{{$org->ausg_rep_email}}</a>
                                <p class="officer-position">AUSG Representative </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->president_studno}}">{{$org->president_name}}</a>
                                <a href="mailto: {{$org->president_email}}" class="officer-email">{{$org->president_email}}</a><br>
                                <p class="officer-position">President </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->vp_internal_studno}}">{{$org->vp_internal_name}}</a>
                                <a href="mailto: {{$org->vp_internal_email}}" class="officer-email">{{$org->vp_internal_email}}</a><br>
                                <p class="officer-position">Vice President for Internal Affairs </p>
                                
                            </div>
                        </div>
            
                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->vp_external_studno}}">{{$org->vp_external_name}}</a>
                                <a href="mailto: {{$org->vp_external_email}}" class="officer-email">{{$org->vp_external_email}}</a><br>
                                <p class="officer-position">Vice President for External Affairs</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->secretary_studno}}">{{$org->secretary_name}}</a>
                                <a href="mailto: {{$org->secretary_email}}" class="officer-email">{{$org->secretary_email}}</a><br>
                                <p class="officer-position">Secretary </p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->treasurer_studno}}">{{$org->treasurer_name}}</a>
                                <a href="mailto: {{$org->treasurer_email}}" class="officer-email">{{$org->treasurer_email}}</a><br>
                                <p class="officer-position">Treasurer</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->auditor_studno}}">{{$org->auditor_name}}</a>
                                <a href="mailto: {{$org->auditor_email}}" class="officer-email">{{$org->auditor_email}}</a><br>
                                <p class="officer-position">Auditor</p>
                                
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="officer-card">
                                
                                <br>
                                <a class="officer-name" href="/chatify/{{$org->pro_studno}}">{{$org->pro_name}}</a>
                                <a href="mailto: {{$org->pro_email}}" class="officer-email">{{$org->pro_email}}</a><br>
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
                    Email: <a href=" mailto: {{$org->org_email}}">{{$org->org_email}}</a><br>
                    FB: <a href="{{$org->org_fb}}" target="_blank">{{$org->org_fb}}</a><br>

                    <H2 style="text-align: start;">Facebook Page:</H2><br>
                    <div id="fb-root">

                    </div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="z2ywPdxc"></script>
                    <div class="row mt-3">
                        <div class="fb-page" data-href="{{$org->org_fb}}" data-tabs="timeline" 
                        data-width="500" data-height="" data-small-header="true" data-adapt-container-width="false" 
                        data-hide-cover="true" data-show-facepile="true"><blockquote cite="{{$org->org_fb}}" 
                        class="fb-xfbml-parse-ignore"><a href="{{$org->org_fb}}">{{$org->name}}</a></blockquote></div>
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
                            <iframe src="/storage/consti_and_bylaws/{{$org->consti_and_byLaws}}" width="100%" height="600px"></iframe>
            
                            <!-- Details for Letter of Intent -->
                            <h2 class="mt-4 mb-3">Letter of Intent</h2>
                            <iframe name="letter_of_intent" src="/storage/letter_of_intent/{{$org->letter_of_intent}}" width="100%" height="600px"></iframe>
            
                            <!-- Details for Adviser Endorsement -->
                            <h2 class="mt-4 mb-3">Adviser Endorsement</h2>
                            <iframe src="/storage/admin_endorsement/{{$org->admin_endorsement}}" width="100%" height="600px"></iframe>
                            </center>
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
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'none';
     }

     function showListOfOfficers() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'block';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'none';
     }
     function showContactUs() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'block';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'none';
     }
     function showEvents() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'block';
         document.getElementById('MoreInfo').style.display = 'none';
     }
     function showMoreInfo() {
         document.getElementById('missionVisionContent').style.display = 'none';
         document.getElementById('listOfOfficersContent').style.display = 'none';
         document.getElementById('ContactUs').style.display = 'none';
         document.getElementById('Events').style.display = 'none';
         document.getElementById('MoreInfo').style.display = 'block';
     }

 </script>
<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to delete this page?")) {
            return true;
        } else {
            return false;
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var org_id = {{$org->id}};
      var calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
          center: 'title',
          right: 'prev,next today',
        },
        events: {
          url: '/org_page/event/' + org_id, // Specify the URL to fetch events data from
          method: 'GET'
        }
        
      });
      calendar.render();
    });
  </script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>