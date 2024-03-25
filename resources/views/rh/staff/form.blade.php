@php
    if ($staff->exists) {
    $user = \App\Models\User::get()->where('staff_id', $staff->id)->first();
    if ($user !== null && $user->role !== null)
    {
        $staffRole = $user->role;
    }
}
@endphp
@extends('dashboard')

@section('title', $staff->exists ? 'Modifier un membre' : 'Ajouter un membre')

@section('contents')


    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">{{ $staff->exists ? 'Modifier un membre' : 'Ajouter un membre' }}</h1>
        <a href="{{ route('rh.staff.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <form action="{{ $staff->exists ? route('rh.staff.update', $staff) : route('rh.staff.store') }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @if($staff->exists)
                @method('PATCH')
            @endif

            {{-- Premiere partie du formulaire sur les informations personnels entoure d'un div avec border et ombre    --}}
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 mt-6 w-11/12 mx-auto">
            <h2 class="text-xl font-bold mb-8">Informations Personnelles</h2>


            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom & Prénom</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $staff->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Téléphone:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                                <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                            </svg>
                        </div>
                        <input value="{{ old('phone', $staff->phone) }}" name="phone" type="text" id="phone" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  placeholder="123-456-7890" required />
                    </div>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Select a phone number that matches the format.</p>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
                    <input type="text" name="address" id="address"
                             value="{{ old('address', $staff->address) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>



            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date de Naissance</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('name', $staff->date_of_birth) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{--  Ajout de l'image          --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="image" id="image"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>
            {{-- Fin premiere partie            --}}

            {{-- Deuxieme partie du formulaire sur les Informations Professionnelles entoure d'un div avec border et ombre    --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 mt-6 w-11/12 mx-auto">
                <h2 class="text-xl font-bold mb-8">Informations Professionnelles</h2>

                {{-- Ajouts des talents par block de type de talent            --}}
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="job_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poste</label>
                        <input type="text" name="job_title" id="job_title"
                               value="{{ old('position', $staff->job_title) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('job_title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salaire</label>
                        <input type="text" name="salary" id="salary"
                               value="{{ old('salary', $staff->salary) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('salary')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="team_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Equipe</label>
                        <select name="team_id" id="team_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Choisir l'équipe</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}" {{ old('team_id', $staff->team_id) == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                            @endforeach
                        </select>
                        @error('team_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="chef_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Chef</label>
                        <select name="chef_id" id="chef_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Choisir le chef</option>
                            @foreach($chiefs as $chief)
                                <option value="{{ $chief->id }}" {{ old('chief_id', $staff->chief_id) == $chief->id ? 'selected' : '' }}>{{ $chief->name }}</option>
                            @endforeach
                        </select>
                        @error('chef_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option>Choisir le statut</option>
                            <option value="active" {{ old('status', $staff->status) == 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ old('status', $staff->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Gerer les roles                    --}}

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Roles</label>
                        <select name="role" id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">Choisir le role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{($staff->exists && $user && $staffRole == $role) ? 'selected' : '' }}>{{ $role }}</option>                            @endforeach
                        </select>
                        @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- Fin            --}}

            </div>
            {{-- Fin deuxieme partie            --}}

            {{-- Troisieme partie du formulaire sur les talents entoure d'un div avec border et ombre    --}}
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 mt-6 w-11/12 mx-auto">
                <h1 class="text-2xl font-bold mb-4">Talents</h1>

                {{-- Ajouts des talents par block de type de talent            --}}
                <div class="mx-4">
                    @foreach($talentTypes as $talentType)
                            <div class="mx-4 mb-5">
                                @php
                                    $talentsForType = $talents->where('talent_type_id', $talentType->id);
                                @endphp
                                @include('share.select', [
                                    'name' => 'talents',
                                    'options' => $talentsForType,
                                    'value' => $staff->talents->where('talent_type_id', $talentType->id)->pluck('id'),
                                    'label' => $talentType->name
                                ])
                            </div>
                    @endforeach
                </div>
                {{-- Fin            --}}

            </div>
            {{-- Fin troisieme partie            --}}

            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    {{ $staff->exists ? 'Modifier' : 'Ajouter' }}
                </button>
            </div>
        </form>
    </div>



@endsection

