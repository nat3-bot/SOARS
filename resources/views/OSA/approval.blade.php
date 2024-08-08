@extends('navbar.navbar_osa')

@section('content')

<main>
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
    <div class="container" >
        <div class="container-event" style="padding: 10px;">
            <h1 style="text-align: start;">Create an event</h1>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createEventModal" >Create an Event</button>
        </div>
    </div>

    <div class="container" style="margin-top: 20px;">
        <h1 style="text-align: start;">Calendar of Events</h1>
        <div id='calendar' style="background-color: rgb(255, 255, 255); padding: 10px 10px 20px 10px; margin-bottom: 100px; margin-bottom:100px;"></div>
    </div>

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
                <td>{{$approve->activity_end_date}} @ {{$approve->activity_end_time}}</td>
                <td>{{$approve->venue}}</td>
                <td>
                    <button type="submit" name="edit" value="edit_{{$approve->id}}" class= "btn btn-warning"style="padding-bottom:10px;">Edit</button>
                </td>
            </tr>
            @endforeach
        </table>
        </form>
            <br>
    </center>

    <div class="container">
        <h1 style="text-align: start;">Pending Events</h1>
    </div>
    <center>
    <div class="table-responsive" style="margin: 0px 110px 0px 110px;">
    <div class="container-tbl-up" style="padding: 0px 0px !important; " >
        <form method="post" action="/osaemp/activity_approval/event_approve_or_edit" >
            @csrf
            
            <table class="table table-bordered table-center" style="padding:0px 50px 0px 50px;"> <br>
           </thead>
            <thead>
                
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Org</th>
                    <th>Activity Title</th>
                    <th>Type of Activity</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Venue</th>
                    <th>Participants</th>
                    <th>Partner Org</th>
                    <th>Org Fund</th>
                    <th>Solidarity Share</th>
                    <th>Registration Fee</th>
                    <th>AUSG Subsidy</th>
                    <th>Sponsored By</th>
                    <th>Ticket Selling</th>
                    <th>Ticket No.</th>
                    <th>Other Source</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activity as $key => $event)
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->status}}</td>
                    <td>{{$event->organization_name}}</td>
                    <td>{{$event->activity_title}}</td>
                    <td>{{$event->type_of_activity}}</td>
                    <td>{{$event->activity_start_date}}</td>
                    <td>{{$event->activity_end_date}}</td>
                    <td>{{$event->activity_start_time}}</td>
                    <td>{{$event->activity_end_time}}</td>
                    <td>{{$event->venue}}</td>
                    <td>{{$event->participants}}</td>
                    <td>{{$event->partner_organization}}</td>
                    <td>{{$event->organization_fund}}</td>
                    <td>{{$event->solidarity_share}}</td>
                    <td>{{$event->registration_fee}}</td>
                    <td>{{$event->AUSG_subsidy}}</td>
                    <td>{{$event->sponsored_by}}</td>
                    <td>{{$event->ticket_selling}}</td>
                    <td>{{$event->ticket_control_number}}</td>
                    <td>{{$event->other_source_of_fund}}</td>
                    <td>{{$event->comments}}</td>
                    <td>
                        <button type="submit" name="approve" value="approve_{{$event->id}}" class="btn btn-success" style="padding-bottom:10px;">Approve</button>
                        <button type="submit" name="edit" value="edit_{{$event->id}}" class= "btn btn-primary"style="padding-bottom:10px;">Comment</button>
                        <button type="submit" name="action" value="reject_{{$event->id}}" class="btn btn-warning" style="padding-bottom:10px;">Reject</button>
                        <button type="submit" name="delete" value="reject_{{$event->id}}" class="btn btn-danger" style="padding-bottom:10px;">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody> 
            </table>
        </form>
    </div>
    </div>
    </center>
                
                
</main>

 <!-- "Approve" Confirmation Modal -->
 <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve this event?
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                <button type="button" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- "Reject" Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Confirmation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to reject this event?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                
            </div>
        </div>
    </div>
</div>



<!-- Create Event Modal -->
<div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel" aria-hidden="true">
<div class="modal-dialog " role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="createEventModalLabel">Create an Event</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form style="max-width: 400px; margin: auto;" method="post" action="/osaemp/activity_approval">
                @csrf
                

                <!-- Event details input fields -->
                

                <div class="form-group row mb-2">
                    <label for="eventName" class="col-sm-4 col-form-label text-left">Event Status:</label>
                    <div class="col-sm-8">
                        <div class="col-sm-11">
                            <select class="form-control" id="eventStatus" name="status"  required>
                                <option value="Standby">Standby</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventOrgname" class="col-sm-4 col-form-label text-left">Organization:</label>
                    <div class="col-sm-8">
                        <div class="col-sm-11">
                            <select class="form-control" id="organization_name" name="organization_name" onchange="showHideOthers(this);" required>
                                @foreach($org as $org_name)
                                <option value="{{$org_name->name}}">{{$org_name->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group row mb-2">
                    <label for="eventOrgname" class="col-sm-4 col-form-label text-left">Activity Name: </label>
                    <div class="col-sm-8">
                        <input type="text" class="activity_title-control" id="activity_title" name="activity_title" required>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label for="eventName" class="col-sm-4 col-form-label text-left">Activity Type: </label>
                    <div class="col-sm-8">
                        <div class="col-sm-11">
                            <select class="form-control" id="type_of_activity" name="type_of_activity" onchange="showHideOthers(this);" required>
                                <option value="Organizational related">Organizational related</option>
                                <option value="Environmental">Environmental</option>
                                <option value="Organizational Development">Organizational Development</option>
                                <option value="Spiritual Enrichment">Spiritual Enrichment</option>
                                <option value="Community Involvement">Community Involvement</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="eventDate" class="col-form-label text-left">Start of Event Date:</label>
                                <input type="date" class="form-control" id="activity_start_date" name="activity_start_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="eventDate" class="col-form-label text-left">End of Event Date:</label>
                                <input type="date" class="form-control" id="activity_end_date" name="activity_end_date" required>
                            </div>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="eventTime" class="col-form-label text-left">Start of Event Time:</label>
                                <input type="time" class="form-control" id="activity_start_time" name="activity_start_time" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="eventTime" class="col-form-label text-left">End of Event Time:</label>
                                <input type="time" class="form-control" id="activity_end_time" name="activity_end_time" required>
                            </div>
                        </div>
                    </div>
                <div class="form-group row mb-2">
                    <label for="eventLocation" class="col-sm-4 col-form-label text-left">Event Location:</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="venue" name="venue" onchange="showHideOthers(this);" required>
                            <option value="TBA">TBA</option>
                            <option value="SV Hall">SV Hall</option>
                            <option value="ST Quad">ST Quad</option>
                            <option value="Adamson Theatre">Adamson Theatre</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Participants:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="participants" name="participants" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Partner Organization:</label>
                    <div class="col-sm-8">

                        <select class="form-control" id="partner_organization" name="partner_organization" onchange="showHideOthers(this);">
                            <option value="None">--None--</option>
                            @foreach($org as $org_name)
                            <option value="{{$org_name->name}}">{{$org_name->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Organization fund:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="organization_fund" name="organization_fund">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Solidarity Share:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="solidarity_share" name="solidarity_share">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Registration Fee:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="registration_fee" name="registration_fee">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">AUSG Subsidy:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="AUSG_subsidy" name="AUSG_subsidy">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Sponsored By:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sponsored_by" name="sponsored_by" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Ticket Selling:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="ticket_selling" name="ticket_selling" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Ticket Control #:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="ticket_control_number" name="ticket_control_number" >
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Other Source</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="other_source_of_fund" name="other_source_of_fund">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="eventDate" class="col-sm-4 col-form-label text-left">Comments</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="comments" name="comments">
                    </div>
                </div>

                <!-- ... (other event details input fields) ... -->
                <button type="Submit" class="btn btn-primary btn-block" >Next</button>
                <button type="" class="btn btn-danger btn-block" data-bs-dismiss="modal">Cancel</button>
            </form>
        </div>
    </div>
</div>
</div>



<!------

<div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Send Email To</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <label><input type="checkbox" id="checkbox1"> RSO</label><br>
            <label><input type="checkbox" id="checkbox2"> Student Leaders</label><br>
            <label><input type="checkbox" id="checkbox3"> Members</label><br>
            <label><input type="checkbox" id="checkbox4"> Send to all</label><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="createEvent()">Create</button>
            <button type="button" class="btn btn-secondary" onclick="closePopup()">Cancel</button>
        </div>
    </div>
</div>
</div>


--->





<script>
function showEmailModal() {
    // Hide the create event modal
    $('#createEventModal').modal('hide');
    // Show the send email modal
    $('#sendEmailModal').modal('show');
}

function closePopup() {
    // Hide the send email modal
    $('#sendEmailModal').modal('hide');
}

function createEvent() {
    // Add your logic to handle the creation of the event and sending emails
    // You can access checkbox values using document.getElementById('checkbox1').checked
    // Close the popup after handling the event creation
    closePopup();
}
</script>

<script>
function showHideOthers(selectElement) {
    var otherLocationDiv = document.getElementById('othersLocation');
    var otherLocationInput = document.getElementById('otherEventLocation');

    if (selectElement.value === 'others') {
        otherLocationDiv.style.display = 'block';
        otherLocationInput.required = true;
    } else {
        otherLocationDiv.style.display = 'none';
        otherLocationInput.required = false;
    }
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
          url: '/osaemp/dash', // Specify the URL to fetch events data from
          method: 'GET'
        }
        
      });
      calendar.render();
    });
  </script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
  






@endsection

