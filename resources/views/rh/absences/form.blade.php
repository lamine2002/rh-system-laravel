@extends('dashboard')

@section('title', 'Absences')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $absence->exists ? 'Modifier une absence' : 'Ajouter une absence' }}</h1>
        <a href="{{ url()->previous() }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form method="post"  action="{{ $absence->exists ? route("rh.absences.update", $absence) : route("rh.absences.store") }}" >
            @csrf
            @if($absence->exists)
                @method('patch')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>

                    @if(auth()->user()->role === 'staff')
                        <input type="hidden" name="staff_id" value="{{ auth()->user()->staff_id }}">
                            <label for="userName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Faites Par</label>
                            <input type="text" name="userName" id="userName" value="{{ auth()->user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly>
                            @error('staff_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                    @else
                        <label for="staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Membre</label>
                        <select name="staff_id" id="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Choisir un membre</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id', $absence->staff_id) == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                            @endforeach
                        </select>
                        @error('staff_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    @endif
                </div>
                <div>
                    <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Raison</label>
                    <input type="text" name="reason" id="reason" value="{{ old('reason', $absence->reason) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('reason')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de Debut</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $absence->start_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('start_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de Fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $absence->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Ajouter le status           --}}
            <div class="grid grid-cols-2 gap-4 mt-4">
                @if(auth()->user()->role === 'staff')
                    <input type="hidden" name="status" value="En attente">
                    <div>
                        <label for="defaultStatus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statut Par Defaut</label>
                        <input type="text" name="defaultStatus" id="defaultStatus" value="En attente" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @else
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Choisir un status</option>
                            <option value="En attente" {{ old('status', $absence->status) == 'En attente' ? 'selected' : '' }}>En attente</option>
                            <option value="Approuvée" {{ old('status', $absence->status) == 'Approuvée' ? 'selected' : '' }}>Approuvé</option>
                            <option value="Rejetée" {{ old('status', $absence->status) == 'Rejetée' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $absence->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>

   {{-- <script>
        --}}{{-- verifier ce que envoie le formulaire        --}}{{--
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = {};
            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }
            console.log(data);
        });
    </script>--}}
@endsection
