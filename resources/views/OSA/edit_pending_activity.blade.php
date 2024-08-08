@extends('navbar.navbar_osa')
@section('content')
@csrf
    
    @foreach ( $pending_event as $events => $event)
<form style="max-width: 400px; margin: auto; padding: 150 0 50 0 ;" method="post" action="/osaemp/activity_approval/edit_save/{{ $event->id }}">
    @csrf
        
    
    <!-- Event details input fields -->
    <div class="form-group row mb-2">
        <label for="id" class="col-sm-4 col-form-label text-left">ID:</label>
        <div class="col-sm-8">
            <label for="id" class="col-sm-4 col-form-label text-left">{{ $event->id}}</label>
        </div>
    </div>

    <div class="form-group row mb-2">
        <label for="eventName" class="col-sm-4 col-form-label text-left">Event Status:</label>
        <div class="col-sm-8">
            <div class="col-sm-8">
                <select class="form-control" id="eventStatus" name="status"  required>
                    <option value="Standby">Standby</option>
                    <option value="Rejected">Rejected</option>
                    <option value="On Hold">On Hold</option>
                    <option value="Done">Done</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group row mb-2">
        <label for="eventOrgname" class="col-sm-4 col-form-label text-left">Organization Name:</label>
        <div class="col-sm-8">
            <select class="form-control" id="organization_name" name="organization_name" onchange="showHideOthers(this);" required>
                
                @if (isset($event->organization_name) )
                    <option value="{{$event->organization_name}}">{{$event->organization_name}}</option>
                @endif
                @foreach($partner_org as $org_name)
                @if ($event->organization_name == null)
                <option value="{{$org_name->name}}">{{$org_name->name}}</option>
                @endif
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="form-group row mb-2">
        <label for="eventOrgname" class="col-sm-4 col-form-label text-left">Activity Name: </label>
        <div class="col-sm-8">
            <input type="text" class="activity_title-control" id="activity_title" name="activity_title" value="{{ $event->activity_title}}" required>
        </div>
    </div>

    <div class="form-group row mb-2">
        <label for="eventName" class="col-sm-4 col-form-label text-left">Activity Type: </label>
        <div class="col-sm-8">
            <div class="col-sm-8">
                <select class="form-control" id="type_of_activity" name="type_of_activity" onchange="showHideOthers(this);" required>
                    <option value="Organizational related" {{ $event->type_of_activity == 'Organizational related' ? 'selected' :' '}}>Organizational related</option>
                    <option value="Environmental" {{ $event->type_of_activity == 'Environmental' ? 'selected' :' '}}>Environmental</option>
                    <option value="Organizational Development" {{ $event->type_of_activity == 'SV Hall' ? 'selected' :' '}}>Organizational Development</option>
                    <option value="Spiritual Enrichment" {{ $event->type_of_activity == 'Spiritual Enrichment' ? 'selected' :' '}}>Spiritual Enrichment</option>
                    <option value="Community Involvement" {{ $event->type_of_activity == 'Community Involvement' ? 'selected' :' '}}>Community Involvement</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Start of Event Date:</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" id="activity_start_date" name="activity_start_date" value="{{ $event->activity_start_date}}" required>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">End of Event Date:</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" id="activity_end_date" name="activity_end_date" value="{{ $event->activity_end_date}}" required>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventTime" class="col-sm-4 col-form-label text-left">Start of Event Time:</label>
        <div class="col-sm-8">
            <input type="time" class="form-control" id="activity_end_time" name="activity_start_time" value="{{$event->activity_start_time}}" required>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventTime" class="col-sm-4 col-form-label text-left">End of Event Time:</label>
        <div class="col-sm-8">
            <input type="time" class="form-control" id="activity_end_time" name="activity_end_time" value="{{$event->activity_end_time}}"required>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventLocation" class="col-sm-4 col-form-label text-left">Event Location:</label>
        <div class="col-sm-8">
            <select class="form-control" id="venue" name="venue" onchange="showHideOthers(this);" required>
                <option value="TBA" {{ $event->venue == 'TBA' ? 'selected' :' '}}>TBA</option>
                <option value="SV HAll" {{ $event->venue == 'SV Hall' ? 'selected' :' '}}>SV Hall</option>
                <option value="ST Quad" {{ $event->venue == 'ST Quad' ? 'selected' :' '}}>ST Quad</option>
                <option value="Adamson Theatre" {{ $event->venue == 'Adamson Theatre' ? 'selected' :' '}}>Adamson Theatre</option>
            </select>
        </div>
    </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Participants:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="participants" name="participants" value="{{$event->participants}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Partner Organization:</label>
        <div class="col-sm-8">
            <select class="form-control" id="partner_organization" name="partner_organization" onchange="showHideOthers(this);">
                
                @if ($event->partner_organization == null)
                <option value="{{$org_name->name}}">{{$org_name->name}}</option>
                @endif
                @if (isset($event->partner_organization) )
                    <option value="{{$event->partner_organization}}">{{$event->partner_organization}}</option>
                @endif
                @foreach($partner_org as $org_name)
                
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Organization fund:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="organization_fund" name="organization_fund" value="{{$event->organization_fund}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Solidarity Share:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="solidarity_share" name="solidarity_share" value="{{$event->solidarity_share}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Registration Fee:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="registration_fee" name="registration_fee" value="{{$event->registration_fee}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">AUSG Subsidy:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="AUSG_subsidy" name="AUSG_subsidy" value="{{$event->AUSG_subsidy}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Sponsored By:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="sponsored_by" name="sponsored_by" value="{{$event->sponsored_by}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Ticket Selling:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="ticket_selling" name="ticket_selling" value="{{$event->ticket_selling}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Ticket Control #:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="ticket_control_number" name="ticket_control_number" value="{{$event->ticket_control_number}}">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">Other Source</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="other_source_of_fund" name="other_source_of_fund" value="{{$event->other_source_of_fund}}">
        </div>
    </div>
    
    <div class="form-group row mb-2">
        <label for="eventDate" class="col-sm-4 col-form-label text-left">LOA</label>
        <h6 style="text-align: start;">
        <iframe src="/storage/letter_of_approval/{{$event->letter_of_approval}}" width="100%" height="600px"></iframe>
        </h6>
    </div>
    
    <div class="form-group row mb-2">
        <label for="comments" class="col-sm-4 col-form-label text-left">Comments</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="comments" name="comments" rows="3">{{$event->comments}}</textarea>
        </div>
    </div>


    <!-- ... (other event details input fields) ... -->
    <button type="submit" name="edited" value="{{$event->id}}" class="btn btn-primary btn-block">Done</button>
    @endforeach
</form>

@endsection