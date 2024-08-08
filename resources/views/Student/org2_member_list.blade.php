@extends('navbar.navbar_student')

@section('content')


<main style="margin-top:20px;">
        
    <div class="container-user-list">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Member category
            </button>
            <ul class="dropdown-menu">
              
                <li><a class="dropdown-item" href="#">Organization</a></li>
              
            </ul>
          </div>
        <div class="table-responsive"> <!-- Add this div to make the table responsive -->
            <table class="table table-bordered table-center"> <!-- Added table-center class -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Member Role</th>
                        <th>Chat</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($info as $inf)
                        
                    
                    <tr>
                        <td>{{$inf->student_id}}</td>
                        <td>{{$inf->last_name}}, {{$inf->first_name}} {{$inf->middle_initial}}</td>
                        <td>{{$inf->email}}</td>
                        <td>{{$inf->org2_member_status}}</td>
                        <td>
                            <a href="/chatify/{{$inf->student_id}}" class="btn btn-success" style="padding-bottom:10px;">Chat</a>
                        </td>
                        

                    </tr>
                    @endforeach
                    <!-- Add more user rows here -->
                </tbody>
            </table>
        </div>
    </div>
   
   
</main>



@endsection