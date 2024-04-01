@extends('dashboard')

@section('title', $leave->exists ? 'Modifier une demande de congé' : 'Ajouter une demande de congé')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $leave->exists ? 'Modifier une demande de congé' : 'Ajouter une demande de congé' }}</h1>
        <a href="{{ url()->previous() }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $leave->exists ? route('rh.leave.update', $leave) : route('rh.leave.store') }}" method="POST">
            @csrf
            @if($leave->exists)
                @method('PATCH')
            @endif

            <div class="grid grid-cols-2 gap-4">

                @if(auth()->user()->role === 'staff')
                    <input type="hidden" name="staff_id" value="{{ auth()->user()->staff_id }}">
                    <div>
                        <label for="UserName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Faites Par</label>
                        <input type="text" name="UserName" id="UserName" value="{{ auth()->user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly>
                        @error('UserName')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div>
                        <label for="staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Staff</label>
                        <select name="staff_id" id="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Choisir un membre</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id', $leave->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                            @endforeach
                        </select>
                        @error('staff_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                @if(auth()->user()->role === 'staff')
                    <input type="hidden" name="status" value="En attente">
                    <div>
                        <label for="defaultStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statut Par Defaut</label>
                        <input type="text" name="defaultStatus" id="defaultStatus" value="En attente" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly>
                        @error('defaultStatus')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                @else
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @foreach($status as $stat)
                                <option value="{{ $stat }}" {{ old('status', $leave->status) == $stat ? 'selected' : '' }}>{{ $stat }}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de début</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $leave->start_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $leave->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Ajout du select types de conges            --}}
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type de congé</label>
                    <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Choisir un type de congé</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('type', $leave->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $leave->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
