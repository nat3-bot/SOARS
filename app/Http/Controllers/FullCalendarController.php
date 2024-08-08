<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class FullCalendarController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Event::whereDate('activity_start_date', '>=', $request->activity_start_date)
                       ->whereDate('activity_end_date',   '<=', $request->activity_end_date)
                       ->get(['id', 'activity_title', 'activity_start_date', 'activity_end_date']);
  
            return response()->json($data);
        }
    }

    public function lol(){
        $events = Event::all();

        $formattedEvents = $events->map(function ($event) {
            return [
                'activity_title' => $event->title,
                'activity_start_date' => $event->start,
                'activity_end_date' => $event->end,
            ];
        });

        return view('fullcalendar', compact('formattedEvents'));
    }

    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'activity_title' => $request->title,
                  'activity_start_date' => $request->start,
                  'activity_end_date' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Event::find($request->id)->update([
                  'activity_title' => $request->title,
                  'activity_start_date' => $request->start,
                  'activity_end_date' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Event::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             //tentative
             break;
        }
    }
}
