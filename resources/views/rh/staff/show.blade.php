@extends('dashboard')

@section('contents')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Détails de {{ $staff->name }}</h1>
                <a href="{{ route('rh.staff.index') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                    Retour
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded shadow-md">
                    <div class="flex items-center justify-center mb-4">
                        @if($staff->image)
                            <img src="{{ $staff->imageUrl() }}" alt="photo de profil" class="w-24 h-24 rounded-full object-cover">
                        @else
                            <img src="https://source.unsplash.com/100x100?portrait" alt="photo de profil" class="w-24 h-24 rounded-full object-cover">
                        @endif
                    </div>
                    <div class="text-center">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $staff->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ $staff->job_title }}</p>
                    </div>
                </div>
                <div class="col-span-2 bg-gray-100 dark:bg-gray-800 p-4 rounded shadow-md">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Email</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Téléphone</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Adresse</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->address }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Date de naissance</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->date_of_birth }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Salaire</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->salary }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Equipe</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->team->name ?? 'Aucune équipe' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Chef</p>
                            <p class="text-gray-800 dark:text-white">{{ $staff->chef->name ?? 'Aucun chef' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Statut</p>
                            <p
                                class="text-gray-800 dark:text-white">{{ $staff->status }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ajouter les talents regrouper par type de talent            --}}
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mt-5">Talents</h1>
        @foreach($talentTypes as $talentType)
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ $talentType->name }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($staff->talents as $talent)
                            @if($talent->talent_type_id == $talentType->id)
                                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded shadow-md">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $talent->type }}</p>
                                    <p class="text-gray-800 dark:text-white">{{ $talent->name }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
            {{--<div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Talents</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($staff->talents as $talent)
                            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded shadow-md">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $talent->type }}</p>
                                <p class="text-gray-800 dark:text-white">{{ $talent->name }}</p>
                            </div>
                        @endforeach
                    </div>
            </div>--}}
    </div>
@endsection
