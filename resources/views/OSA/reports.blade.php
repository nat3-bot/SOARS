@extends('navbar.navbar_osa')
@section('content')


<main>
    <div class="container-report-list">
    
        <div class="table-responsive"> <!-- Add this div to make the table responsive -->
            <div class="col-10" style="padding: 10px;">
                 <!-- Use the entire row -->
                <h2 class="text-left">PAST EVENTS</h2>
            </div>
            <table class="table table-bordered table-center"> <!-- Added table-center class -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Organization</th>
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
                            <th>Ticket Control No.</th>
                            <th>Other Source of Fund</th>
                            <th>Action</th>
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
                            <td>
                            <a href="{{ route('generate-certificate', ['eventId' => $event->id]) }}" class="btn btn-primary">Generate Certificate</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> 
                    </table>
        </div>
    </div>

   <div class="container-report-list" style="padding-top: 20px;">
    <div class="row">
        <div class="col-10"> <!-- Use the entire row -->
            <h2 class="text-left">PAYPAL TRANSACTIONS</h2>
            <form action="{{ url('/osaemp/open_registration') }}" method="POST">
                @csrf
                <button type="submit" name="regopen" value="1" id="regopen" class="btn btn-primary mb-3">Open Registration</button>
                <button type="submit" name="regclose" value="0" id="regclose" class="btn btn-primary mb-3">Close Registration</button>
                
            </form>
            <div class="alert alert-success">
                {{$regstatus}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student No.</th>
                            <th>Name</th>
                            <th>Organization</th>
                            <th>Payment ID</th>
                            <th>Amount</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paypal as $payment)
                            
                        
                        <tr>
                            <th>{{$payment->id}}</th>
                            <th>{{$payment->studno}}</th>
                            <th>{{$payment->name}}</th>
                            <th>{{$payment->organization}}</th>
                            <th>{{$payment->payment_id}}</th>
                            <th>{{$payment->amount}}{{$payment->currency}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>



@endsection