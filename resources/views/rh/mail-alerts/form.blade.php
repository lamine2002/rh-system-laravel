@extends('dashboard')

@section('title', $mail_alert->exists ? 'Modifier une alerte mail' : 'Ajouter une alerte mail')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $mail_alert->exists ? 'Modifier une alerte mail' : 'Ajouter une alerte mail' }}</h1>
        <a href="{{ route('rh.mail-alerts.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $mail_alert->exists ? route('rh.mail-alerts.update', $mail_alert) : route('rh.mail-alerts.store') }}" method="POST">
            @csrf
            @if($mail_alert->exists)
                @method('PATCH')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Choisir le type</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('type', $mail_alert->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Staff</label>
                    <select name="staff_id" id="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Choisir le staff</option>
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ old('staff_id', $mail_alert->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                        @endforeach
                    </select>
                    @error('staff_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                <textarea name="message" id="message" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('message', $mail_alert->message) }}</textarea>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $mail_alert->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

@endsection
