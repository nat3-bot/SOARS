@extends('navbar.navbar_student')
@section('content')

</head>
<body>
<main style="overflow-x: hidden;">
  
  @if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger">
    {{session('error')}}
  </div>
  @endif
    @if ($course == null)

    <form method="POST" action="{{url('/student_course')}}">
      @csrf
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose your Course</h1>
            </div>
            <div class="modal-body">
              <select class="form-control" id="course" name="course" required>
                <option value="">Select Course</option>
                <option value="ACT">Associate in Computer Technology</option>
                <option value="BAComm">Bachelor of Arts in Communication</option>
                <option value="BAPhilo">Bachelor of Arts in Philosophy</option>
                <option value="BAPolSci">Bachelor of Arts in Political Science</option>
                <option value="BEEd">Bachelor of Elementary Education</option>
                <option value="BPEd">Bachelor of Physical Education</option>
                <option value="BPE-SWM">Bachelor of Physical Education Major in Sports and Wellness Management</option>
                <option value="BSA">Bachelor of Science in Accountancy</option>
                <option value="BSArchi">Bachelor of Science in Architecture</option>
                <option value="BSBio">Bachelor of Science in Biology</option>
                <option value="BSBAFM">Bachelor of Science in Business Administration Major in Financial Management</option>
                <option value="BSBAMM">Bachelor of Science in Business Administration Major in Marketing Management</option>
                <option value="BSBAOM">Bachelor of Science in Business Administration Major in Operations Management</option>
                <option value="BSChE">Bachelor of Science in Chemical Engineering</option>
                <option value="BSCPT">Bachelor of Science in Chemical Process Technology</option>
                <option value="BSChem">Bachelor of Science in Chemistry</option>
                <option value="BSCE">Bachelor of Science in Civil Engineering</option>
                <option value="BSCooE">Bachelor of Science in Computer Engineering</option>
                <option value="BSCS">Bachelor of Science in Computer Science</option>
                <option value="BSCA">Bachelor of Science in Customs Administration</option>
                <option value="BSEE">Bachelor of Science in Electrical Engineering</option>
                <option value="BSGeo">Bachelor of Science in Geology</option>
                <option value="BSHM">Bachelor of Science in Hospitality Management</option>
                <option value="BSIE">Bachelor of Science in Industrial Engineering</option>
                <option value="BSIS">Bachelor of Science in Information System</option>
                <option value="BSIT">Bachelor of Science in Information Technology</option>
                <option value="BSME">Bachelor of Science in Mechanical Engineering</option>
                <option value="BSMining">Bachelor of Science in Mining Engineering</option>
                <option value="BSNursing">Bachelor of Science in Nursing</option>
                <option value="BSPE">Bachelor of Science in Petroleum Engineering</option>
                <option value="BSPharma">Bachelor of Science in Pharmacy</option>
                <option value="BSPsych">Bachelor of Science in Psychology</option>
            </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Continue</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>

    <script>
      $(document).ready(function() {
          $('#staticBackdrop').modal('show');
      });
    </script>

    @endif

    @if (isset($petition))
    <div class="card text-center" style="margin-top:10%;">
      <div class="card-header">
        <h1>Notice!</h1>
      </div>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success" style="margin-top:2%;">
            {{session('success')}}
          </div>
          @endif

          @if(session('error'))
          <div class="alert alert-danger" style="margin-top:2%;">
            {{session('error')}}
          </div>
          @endif
        <h5 class="card-title">It Appears that the Organization for your course hasn't been made</h5>
        <p class="card-text">If you're an officer of an existing Organization, please click <strong>"Existing Organization"</strong></p>
        <p class="card-text">If the organization hasn't been made, please click the button <strong>"New Organization"</strong></p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#oldOrgModal">
          Existing Organization
        </button>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrgModal">
          New Organization
        </button>
        <a href="/petition_view/{{session('userId')}}" class="btn btn-success">View Sent Petition</a>

      </div>
      <div class="card-footer text-body-secondary">
        By: Office for Students Affairs
      </div>
    </div>

    <!-- Existing Modal -->
    <div class="modal fade" id="oldOrgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">File a Exisiting Organization</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            You are now filing an Existing Organization as a President. Once You've proceed you need to finish the Registration Form<br>
            Do you wish to continue?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <a href="/petition/existing/{{session('userId')}}" class="btn btn-success">Proceed</a>
          </div>
        </div>
      </div>
    </div>

    <!--New-->
    <div class="modal fade" id="newOrgModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">File New Organization</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            You are now filing an <strong>New Organization</strong> as a President. <br>
            Do you wish to continue?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <a href="/petition/new" class="btn btn-success">Proceed</a>
          </div>
        </div>
      </div>
    </div>

    @endif


    @if (isset($announcement1))
    <div class="container" style="padding-top: 8%;">
      <h1>Calendar of Events</h1>
      <div id='calendar' style="background-color: rgb(255, 255, 255); padding: 10px 10px 20px 10px; margin-bottom: 30px;">
      </div>
    </div>

    <div class="container">
            <h1 style="padding-left:20px; padding-top: 5%; padding-bottom: 2.5%;">
                <i class="fas fa-bullhorn"></i> Announcements
            </h1>
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
    </div>

    @endif
    
</main>



<!--Calendar of Events-->
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
 
 
 
 </body>
 </html>
 
@endsection
