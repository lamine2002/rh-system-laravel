@extends('dashboard')

@section('title', 'Mes Congés')

@section('contents')
{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>--}}

    <div id='teamCalendar'></div>

<script src="{{ asset("assets/fullcalendar/dist/index.global.js") }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            initialDate: '2023-01-12',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2023-01-01'
                },
                {
                    title: 'Long Event',
                    start: '2023-01-07',
                    end: '2023-01-10'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-01-09T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-01-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2023-01-11',
                    end: '2023-01-13'
                },
                {
                    title: 'Meeting',
                    start: '2023-01-12T10:30:00',
                    end: '2023-01-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2023-01-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2023-01-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2023-01-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2023-01-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2023-01-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2023-01-28'
                }
            ]
        });

        calendar.render();
    });
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('teamCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'fr',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            events: [
                {
                    title: 'All Day Event',
                    start: '2024-04-03'
                },
                {
                    title: 'Long Event',
                    start: '2024-04-03',
                    end: '2024-04-03'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2024-04-03T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2024-04-03T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2024-04-03',
                    end: '2024-04-03'
                },
                {
                    title: 'Meeting',
                    start: '2024-04-03T10:30:00',
                    end: '2024-04-03T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2024-04-03T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2024-04-03T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2024-04-03T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2024-04-03T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2024-04-03T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2024-04-03'
                }
            ]
        });
        calendar.render();
    });

</script>


@endsection


{{--
@push('JS')
    <script>
        let calendarEl = document.getElementById('teamCalendar');
        let calendar = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            }
        });
        calendar.render();
    </script>
@endpush
--}}
