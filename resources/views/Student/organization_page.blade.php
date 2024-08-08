@extends('navbar.navbar_student')
@section('content')

<main class="container mt-4" style="margin-right: 740px !important; margin-top:8% !important;">
    
    

    <div class="btn-group mb-4" role="group" aria-label="Basic example" style="margin-left:35px;">
        <button type="button" style="margin-left: 230px;" class="btn btn-primary" onclick="showMissionVision()">Mission and Vision</button>
        <button type="button" class="btn btn-primary" onclick="showListOfOfficers()">List of Officers</button>
        <button type="button" class="btn btn-primary" onclick="showContactUs()">Contact Us</button>
        <button type="button" class="btn btn-primary" onclick="showEvents()">Events</button>
        
        <!--Registration Button-->
        @if ($org->type_of_organization != 'Academic' && $org2status->org2_memberstatus == null && $regstatus==1)
            
            <form method="POST" style="margin-left:10px;" action="{{ url('/register/organization/'.$org->id) }}">
                @csrf
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Register 
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog-centered">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Register to {{$org->name}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>You're about to register to {{$org->name}}<p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="" class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            
        @endif
        
        <!--Payment Button-->
        @if($org2status->org2_memberstatus == "Applying Member")
                          
                
                <button  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Pay 200 Pesos for Membership </button>
                <!-- Button trigger modal -->

                
                <!-- Modal -->
                
            <form method="POST" action="{{ url('/register/organization/'.$org->id) }}">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">You're about to pay 200 Pesos</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        You are abot to pay 200 pesos as a membership fee for the Organization, you will be now redirected to the Payment Page
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="pay(event)" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            <form method="POST" style="margin-left:10px;" action="{{url('/cancel_register/organization/'.$org->id)}}">
                <button onclick="cancel(event)" type="submit" style="text-align:end;" class="btn btn-danger">Cancel Registration</a>
            </form>
        @endif



        <!--Show Receipt of the Payment-->
        @if ($org2status->org2_memberstatus == "Paid")
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            View Receipt
        </button>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                ...
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </div>
        </div>

        @endif


        <!--Create Refund Process for Paid and Member-->
    </div>
        
    
     <br>
        

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @if($org2status->org2_memberstatus == 'Paid')
            
            <center>
            <div class="alert alert-success">
                <p>You are currently Paid, please wait for the validation of payment </p>
            </div>
            </center>
            @endif
            
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



    function pay(event) {
    event.preventDefault();
    
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ url('/register/organization/'.$org->id) }}";
        form.style.display = 'none'; // Hide the form

        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }

    function cancel(event) {
    event.preventDefault();
    
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ url('/cancel_register/organization/'.$org->id) }}";
        form.style.display = 'none'; // Hide the form

        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = "{{ csrf_token() }}";
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }




 </script>
<script>
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
  


          

     
     
 
 
 
 <!-- Add Bootstrap JavaScript (optional) -->
 <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->



@endsection