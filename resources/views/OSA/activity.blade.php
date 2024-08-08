@extends('navbar.navbar_osa')

@section('content')


<main>
    <center>
        <h1>Activity List</h1>
        <form form method="post" action="/osaemp/activity_approval/event_approve_or_edit" >
            @csrf
        <table >
            <tr>
                <th>Event Name</th>
                <th>Status</th>
                <th>Organization</th>
                <th>Event Start Date & time</th>
                <th>Event End Date & Time</th>
                <th>Venue</th>
                <th>Button</th>
            </tr>
            @foreach ($approved as $approve)
                
            
            <tr>
                <td><a>{{$approve->activity_title}}</a></td>
                <td><a>{{$approve->status}}</a></td>
                <td><a>{{$approve->organization_name}}</a></td>
                <td>{{$approve->activity_start_date}} @ {{$approve->activity_start_time}}</td>
                <td>{{$approve->activity_end_date}} @ {{$approve->activity_end_date}}</td>
                <td>{{$approve->venue}}</td>
                <td>
                    <button type="submit" name="edit" value="edit_{{$approve->id}}" class="btn btn-create" style="padding-bottom:10px;">View and Edit</button>
                </td>
            </tr>
            @endforeach
        </table>
        </form>
            <br>
    </center>
</main>
    



<!-- Add Bootstrap JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>





@endsection