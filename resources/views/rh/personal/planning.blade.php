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
                </time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $planning->task }}</h3>
                <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $planning->type }}</p>
                <a href="{{ route('rh.planning.show', $planning->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">View Details</a>
            </li>
        @endforeach
    </ol>


@endsection

