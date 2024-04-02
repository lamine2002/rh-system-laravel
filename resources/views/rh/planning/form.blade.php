@extends('dashboard')

@section('title', $planning->exists ? 'Modifier un planning' : 'Ajouter un planning')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $planning->exists ? 'Modifier un planning' : 'Ajouter un planning' }}</h1>
        <a href="{{ route('rh.planning.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $planning->exists ? route('rh.planning.update', $planning) : route('rh.planning.store') }}" method="POST">
            @csrf
            @if($planning->exists)
                @method('PATCH')
            @endif

            <div class="mt-4">
                <label for="planning_staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Membre</label>
                <select name="staff_id" id="planning_staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner un membre</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('staff_id', $planning->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
                @error('staff_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>
            <div class="mt-4">
                <label for="planning_team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Chosir une équipe</label>
                <select name="team_id" id="planning_team_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner une équipe</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id', $planning->team_id) == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                    @endforeach
                </select>
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

@endsection
