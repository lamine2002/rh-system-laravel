@extends('dashboard')

@section('title', 'My Team')

@section('contents')
<h1 class="mb-8 text-3xl font-bold text-gray-900 dark:text-white">Mon Equipe : {{ $team->name }}</h1>
<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
        <li class="me-2">
            <button id="team-tab" data-tabs-target="#team" type="button" role="tab" aria-controls="team" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Equipe</button>
        </li>
        <li class="me-2">
            <button id="completed-plannings-tab" data-tabs-target="#completed-plannings" type="button" role="tab" aria-controls="completed-plannings" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Taches Complétées</button>
        </li>
        <li class="me-2">
            <button id="incompleted-plannings-tab" data-tabs-target="#incompleted-plannings" type="button" role="tab" aria-controls="incompleted-plannings" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Taches Incomplétées</button>
        </li>
    </ul>
    <div id="defaultTabContent">
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="team" role="tabpanel" aria-labelledby="team-tab">
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Membre de l'equipe</h2>
            <ul>
                @php
                    $index = 0;
                @endphp
                @foreach($members as $member)
                    <div class="flex justify-between">
                        <li>{{ $member->name }}</li>
                        @if(auth()->user()->staff_id == $team->leader_id || auth()->user()->staff_id == $team->supervisor_id)
                            <button data-modal-target="crud-modal{{$index}}" data-modal-toggle="crud-modal{{$index}}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg" type="button">
                                Déléguer une tâche
                            </button>
                        @endif

                        <div id="crud-modal{{$index}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-3xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Donner une tâche a {{ $member->name }}
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal{{$index}}">
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
                                            <label for="planning_staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Membre</label>
                                            <input type="text" name="staff_name"  value="{{ $member->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly>
                                            <input type="hidden" name="staff_id" value="{{ $member->id }}">
                                            @error('staff_id')
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
                                            <div>
                                                <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heure de Début</label>
                                                <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $planning->start_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                @error('start_time')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heure de Fin</label>
                                                <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $planning->end_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
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

                        @php
                            $index++;
                        @endphp
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="completed-plannings" role="tabpanel" aria-labelledby="completed-plannings-tab">
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Taches Complétées</h2>
            <ul>
                @foreach($completedTeamPlannings as $planning)
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold">{{ $planning->type }} : </h1>
                        <li class="text-green-500 ml-4">{{ $planning->task }}</li>
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="incompleted-plannings" role="tabpanel" aria-labelledby="incompleted-plannings-tab">
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Taches Incomplétées</h2>
            <ul>
                @foreach($incompletedTeamPlannings as $planning)
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold">{{ $planning->type }} : </h1>
                        <li class="text-red-500 ml-4">{{ $planning->task }}</li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
