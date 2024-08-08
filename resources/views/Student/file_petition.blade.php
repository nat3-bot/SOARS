@extends('navbar.navbar_student')
@section('content')

</head>
<body>
    <div class="card text-center" style="margin:10% 30% 10% 30%;">
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
            <h5 class="card-title">Do you wish to petition a Organization? </h5>
            <p class="card-text">please click the button <strong>"New Organization"</strong></p>
          
          
  
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
  
</body>
</html>
@endsection