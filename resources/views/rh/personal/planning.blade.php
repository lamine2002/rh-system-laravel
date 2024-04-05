@extends('dashboard')

@section('title', 'Mes Congés')

@section('contents')

    <ol class="relative border-s border-gray-200 dark:border-gray-700">
        @foreach($plannings as $planning)
            <li class="mb-10 ms-4">
                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($planning->date)->translatedFormat('l jS F Y') }}
                    de {{ \Carbon\Carbon::parse($planning->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($planning->end_time)->format('H:i') }}
{{--                    à rendre pour le {{ \Carbon\Carbon::parse($planning->end_date)->translatedFormat('l jS F Y') }}--}}
                    {{-- si le jour a rendre = jour d'emission = jour actuel ecrire alors à rendre aujourd'hui --}}
                    @if(\Carbon\Carbon::parse($planning->end_date)->translatedFormat('l jS F Y') == \Carbon\Carbon::now()->translatedFormat('l jS F Y'))
                        à rendre aujourd'hui
                        {{--elseif si la date de remise est passe--}}
                    @elseif(\Carbon\Carbon::parse($planning->end_date) < \Carbon\Carbon::now())
                        <span class="text text-red-500 dark:text-red">
                            date de remise dépassée
                        </span>
                        {{--sinon ecrire à rendre pour le jour de remise--}}
                    @else
                        à rendre pour le {{ \Carbon\Carbon::parse($planning->end_date)->translatedFormat('l jS F Y') }}
                    @endif
                </time>
                <dl>
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
                @can('update', $planning)
{{--                    @if(auth()->user()->staff_id === $planning->team->leader_id)--}}
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
{{--                    @endif--}}
                @endcan
            </li>
        @endforeach
    </ol>

    {{--Ajouter le link de la pagination--}}
    <br>
    {{ $plannings->links() }}

@endsection

