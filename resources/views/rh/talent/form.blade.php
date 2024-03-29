@extends('dashboard')

@section('title', $talent->exists ? 'Modifier un talent' : 'Ajouter un talent')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $talent->exists ? 'Modifier un talent' : 'Ajouter un talent' }}</h1>
        <a href="{{ route('rh.talent.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $talent->exists ? route('rh.talent.update', $talent) : route('rh.talent.store') }}" method="POST">
            @csrf
            @if($talent->exists)
                @method('PATCH')
            @endif

            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $talent->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="talent_type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type de talent</label>
                <select name="talent_type_id" id="talent_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Choisir le type de talent</option>
                    @foreach($talentTypes as $talentType)
                        <option value="{{ $talentType->id }}" {{ old('talent_type_id', $talent->talent_type_id) == $talentType->id ? 'selected' : '' }}>{{ $talentType->name }}</option>
                    @endforeach
                </select>
                @error('talent_type_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $talent->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
