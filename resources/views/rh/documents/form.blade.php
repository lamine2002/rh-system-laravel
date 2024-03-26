@extends('dashboard')

@section('title', $document->exists ? 'Modifier un document' : 'Ajouter un document')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $document->exists ? 'Modifier un document' : 'Ajouter un document' }}</h1>
        <a href="{{ route('rh.documents.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $document->exists ? route('rh.documents.update', $document) : route('rh.documents.store') }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @if($document->exists)
                @method('PATCH')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fichier</label>
                    <input type="file" name="file" id="file" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('file')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Choisir le type</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('type', $document->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Staff</label>
                    <select name="staff_id" id="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Choisir le staff</option>
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ old('staff_id', $document->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                        @endforeach
                    </select>
                    @error('staff_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $document->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
