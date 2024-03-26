@extends('dashboard')

@section('title', $contract->exists ? 'Modifier un contrat' : 'Ajouter un contrat')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $contract->exists ? 'Modifier un contrat' : 'Ajouter un contrat' }}</h1>
        <a href="{{ route('rh.contracts.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $contract->exists ? route('rh.contracts.update', $contract) : route('rh.contracts.store') }}" method="POST">
            @csrf
            @if($contract->exists)
                @method('PATCH')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Membre</label>
                    <select name="staff_id" id="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Sélectionner un membre</option>
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ old('staff_id', $contract->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                        @endforeach
                    </select>
                    @error('staff_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="contract_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type de contrat</label>
                    <select name="contract_type" id="contract_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Sélectionner un type de contrat</option>
                        @foreach($contractTypes as $type)
                            <option value="{{ $type }}" {{ old('contract_type', $contract->contract_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('contract_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de début</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $contract->start_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $contract->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Ajout de l'objet et de la status           --}}
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="object" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Object</label>
                    <input type="text" name="object" id="object" value="{{ old('object', $contract->object) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('object')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Sélectionner un status</option>
                        @foreach($status as $s)
                            <option value="{{ $s }}" {{ old('status', $contract->status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Ajout de la signed_by           --}}
            <div class="mt-4">
                <label for="signed_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Signé Par</label>
                <select name="signed_by" id="signed_by" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner un signataire</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ old('signed_by', $contract->signed_by) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
                @error('signed_by')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $contract->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $contract->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
