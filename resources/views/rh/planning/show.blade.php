@extends('dashboard')
@section('contents')
    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">Détails du Planning</h1>
        <a href="{{ route('rh.team-planning') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Retour</a>
    </div>

    <div class="mt-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Informations sur le Planning</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Détails du planning de l'équipe.</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Equipe</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $planning->team->name }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Date de Debut</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{--formater la date en date francaise--}}
                            {{ \Carbon\Carbon::parse($planning->start_date)->translatedFormat('l jS F Y') }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Date de Fin</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            {{--formater la date en date francaise--}}
                            {{ \Carbon\Carbon::parse($planning->end_date)->translatedFormat('l jS F Y') }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Type</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $planning->type }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Priorité</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($planning->priority == 'Très urgent')
                                <span class="bg-red-500 text-white font-bold py-1 px-2 rounded-lg">{{ $planning->priority }}</span>
                            @elseif($planning->priority == 'Urgent')
                                <span class="bg-yellow-500 text-white font-bold py-1 px-2 rounded-lg">{{ $planning->priority }}</span>
                            @else
                                <span class="bg-green-500 text-white font-bold py-1 px-2 rounded-lg">{{ $planning->priority }}</span>
                            @endif
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Objet</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $planning->task }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Statut</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                            @if($planning->status == 'En attente')
                                <span class="bg-blue-500 text-white font-bold py-1 px-2 rounded-lg">{{ $planning->status }}</span>
                            @elseif($planning->status == 'Complétée')
                                <span class="bg-green-500 text-white font-bold py-1 px-2 rounded-lg">{{ $planning->status }}</span>
                            @else
                                {{--Cela veut dire Incompletée--}}
                                <span class="bg-red-500 text-white font-bold py-1 px-2 rounded-lg">{{ $planning->status }}</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                {{--deux formulaires pour les boutons Complétée et Incompletée --}}
                @can('update', $planning)
                    @if(auth()->user()->staff_id === $planning->team->leader_id)
                        <form action="{{ route('rh.complete-team-planning', $planning->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">Complétée</button>
                        </form>
                        <form action="{{ route('rh.incomplete-team-planning', $planning->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Incomplétée</button>
                        </form>
                    @endif
                @endcan
            </div>
        </div>
    </div>
@endsection
