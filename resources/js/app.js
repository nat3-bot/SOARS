import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, interactionPlugin ],
        // Add other FullCalendar options here
        // For example:
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {
            url: '/osaemp/dash', // Your endpoint for fetching events
            method: 'GET'
        },
        // Add event handlers as needed
        dateClick: function(info) {
            console.log('Clicked on: ' + info.dateStr);
            console.log('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            console.log('View: ' + info.view.type);
        }
    });

    calendar.render();
});