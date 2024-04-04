@extends('dashboard')

@section('title', 'Mes Congés')

@section('contents')
{{--    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>--}}
    <div class="flex justify-between mb-5">
        <h1 class="text-3xl font-bold">Planning de {{ $team->name }}</h1>
        @if(auth()->user()->staff_id === $team->supervisor_id)
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Ajouter un événement
        </button>
        @endif
        </div>
    <div id='teamCalendar'></div>

<script src="{{ asset("assets/fullcalendar/dist/index.global.min.js") }}"></script>
<script>
    const planning = @json($plannings);
    // console.log(planning);

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

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Ajouter un événement
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

                <form class="p-2 md:p-5" action="{{ $planning->exists ? route('rh.planning.update', $planning) : route('rh.planning.store') }}" method="POST">
                    @csrf
                    @if($planning->exists)
                        @method('PATCH')
                    @endif

                    <div class="mt-4">
                        <label for="planning_team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Equipe</label>
                        <input type="hidden" name="team_id" value="{{ $team->id }}">
                        <input type="text" value="{{ $team->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled>
                        @error('team_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Add other fields here in a similar fashion -->
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                            <input type="date" name="date" id="date" value="{{ old('date', $planning->date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de Fin</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $planning->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('end_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="hidden">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heure de Début</label>
                            <input type="time" name="start_time" id="start_time" value="12:00" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('start_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="hidden">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heure de Fin</label>
                            <input type="time" name="end_time" id="end_time" value="18:00" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('end_time')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="task" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task</label>
                        <input type="text" name="task" id="task" value="{{ old('task', $planning->task) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('task')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div >
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Sélectionner un type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ old('type', $planning->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div >
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priorité</label>
                            <select name="priority" id="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Sélectionner une priorité</option>
                                @foreach($priorities as $priority)
                                    <option value="{{ $priority }}" {{ old('priority', $planning->priority) == $priority ? 'selected' : '' }}>{{ $priority }}</option>
                                @endforeach
                            </select>
                            @error('priority')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statuts</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Sélectionner un statut</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $planning->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-center">
                        <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                            {{ $planning->exists ? 'Modifier' : 'Ajouter' }}
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>
