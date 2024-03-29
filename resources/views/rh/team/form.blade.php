@extends('dashboard')

@section('title', $team->exists ? 'Modifier une équipe' : 'Ajouter une équipe')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $team->exists ? 'Modifier une équipe' : 'Ajouter une équipe' }}</h1>
        <a href="{{ route('rh.team.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $team->exists ? route('rh.team.update', $team) : route('rh.team.store') }}" method="POST">
            @csrf
            @if($team->exists)
                @method('PATCH')
            @endif

            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description', $team->description) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="leader_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Chef d'équipe</label>
                <select name="leader_id" id="leader_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Choisir le chef d'équipe</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('leader_id', $team->leader_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
                @error('leader_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="supervisor_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Superviseur</label>
                <select name="supervisor_id" id="supervisor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Choisir le superviseur</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('supervisor_id', $team->supervisor_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
                @error('supervisor_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $team->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
