@extends('dashboard')

@section('title', $talentType->exists ? 'Modifier un type de talent' : 'Ajouter un type de talent')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $talentType->exists ? 'Modifier un type de talent' : 'Ajouter un type de talent' }}</h1>
        <a href="{{ route('rh.talent-type.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $talentType->exists ? route('rh.talent-type.update', $talentType) : route('rh.talent-type.store') }}" method="POST">
            @csrf
            @if($talentType->exists)
                @method('PATCH')
            @endif

            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name', $talentType->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $talentType->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
