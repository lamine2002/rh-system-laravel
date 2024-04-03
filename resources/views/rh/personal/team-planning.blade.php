@extends('dashboard')

@section('title', 'Mes Congés')

@section('contents')
{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>--}}

    <div id='teamCalendar'></div>

<script src="{{ asset("assets/fullcalendar/dist/index.global.min.js") }}"></script>
<script>
    const planning = @json($plannings);
    console.log(planning);

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
            events: planning,

        });
        calendar.render();
    });

</script>


@endsection

