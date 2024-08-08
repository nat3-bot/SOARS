<?php

namespace App\Http\Controllers;

use App\Events\ChatifyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Organization;

use setasign\Fpdi\Fpdi;


class EventController extends Controller
{
    public function view_events(){
        
    }

    public function getEventsOrg($id)
    {
        $org = Organization::findOrFail($id);
        $events = Event::where('organization_name', $org->name)->get(); // Add get() to execute the query
        
        // Format events as required by FullCalendar
        $formattedEvents = $events->map(function ($event) {
            $startDateTime = $event->activity_start_date . 'T' . $event->activity_start_time;
            $endDateTime = $event->activity_end_date . 'T' . $event->activity_end_time;
    
            return [
                'title' => $event->activity_title,
                'start' => $startDateTime,
                'end' => $endDateTime,
            ];
        });
    
        return response()->json($formattedEvents); // Return the formatted events as JSON response
    }

    public function getEventsOrgpage($id){
        $org = Organization::findOrFail($id);
        $events = Event::where('organization_name', $org->name)->get(); // Add get() to execute the query
        
        // Format events as required by FullCalendar
        $formattedEvents = $events->map(function ($event) {
            $startDateTime = $event->activity_start_date . 'T' . $event->activity_start_time;
            $endDateTime = $event->activity_end_date . 'T' . $event->activity_end_time;
    
            return [
                'title' => $event->activity_title,
                'start' => $startDateTime,
                'end' => $endDateTime,
            ];
        });
    
        return response()->json($formattedEvents); // Return the formatted events as JSON response
    }
}
