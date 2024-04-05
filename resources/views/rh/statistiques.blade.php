@extends('dashboard')

@section('contents')
{{-- debut graphe--}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">

    <div class="max-w-xl w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                        <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                        <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
                    </svg>
                </div>
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">
                        {{ $teams }}
                    </h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Nombres d'équipe</p>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-2">
            <dl class="flex items-center">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Taches de la semaine:</dt>
                <dd class="text-gray-900 text-sm dark:text-white font-semibold">{{ $planningsCount }}</dd>
            </dl>
            <dl class="flex items-center justify-end">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">Taux de complétion:</dt>
                <dd class="text-gray-900 text-sm dark:text-white font-semibold">{{ round($planningsCompletedRate) }}%</dd>
            </dl>
        </div>

        <div id="column-chart"></div>
        {{-- Titre du graphe--}}
        <div class="py-4">
            <h3 class="text-center text-2xl font-semibold text-gray-900 dark:text-white">Taches de la semaine</h3>
        </div>
    </div>
    {{-- fin graphe--}}

    {{--Autres Statistiques--}}
    <!--Tabs widget -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">Statistics du Mois
            <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg class="w-4 h-4 ml-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
        </h3>
        <div data-popover id="popover-description" role="tooltip" class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
            <div class="p-3 space-y-2">
                <h3 class="font-semibold text-gray-900 dark:text-white">Statistics</h3>
                <p>Ce sont les statistiques des employées et des équipes ayant accomplis le plus de tache dans ce mois </p>
            </div>
            <div data-popper-arrow></div>
        </div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select tab</label>
            <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option>Statistics</option>
                <option>Services</option>
                <option>FAQ</option>
            </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
            <li class="w-full">
                <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Top Membres</button>
            </li>
            <li class="w-full">
                <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Top Equipes</button>
            </li>
        </ul>
        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
            <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($topStaffs as $topStaff)

                    @php($staff = $topStaff['staff'])
{{--                        @dd($staff)--}}
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    @if($staff && $staff->image)
                                        <img class="flex-shrink-0 w-10 h-10 rounded-full" src="{{ $topStaff['staff']->imageUrl() }}" alt="{{ $topStaff['staff']->name }}">
                                    @else
                                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                            <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            {{($staff && $staff->image) ? $staff->name : 'Inconnu' }}
                                        </p>
                                        <div class="flex items-center flex-1 text-sm text-green-500 dark:text-green-400">
                                            <a href="{{($staff && $staff->id) ? route('rh.staff.show', $staff->id) : redirect()->back()}}" >Voir</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $topStaff['count'] }} taches complétées
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($topTeams as $topTeam)
                        <li class="py-3 sm:py-4">
                            <div class="flex items center justify-between">
                                <div class="flex items center min-w-0">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            {{($topTeam['team'] && $topTeam['team']->name) ? $topTeam['team']->name : 'Inconnu' }}
                                        </p>
                                        <div class="flex items center flex-1 text-sm text-green-500 dark:text-green-400">
                                            <a href="{{($topTeam['team'] && $topTeam['team']->id) ? route('rh.team.show', $topTeam['team']->id) : redirect()->back() }}">Voir</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $topTeam['count'] }} taches complétées
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <!-- Card Footer -->
        <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
            <div>
                 <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="stats-dropdown">
                    <div class="px-4 py-3" role="none">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                            Sep 16, 2021 - Sep 22, 2021
                        </p>
                    </div>
                    <ul class="py-1" role="none">
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Yesterday</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Today</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 7 days</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 30 days</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Last 90 days</a>
                        </li>
                    </ul>
                    <div class="py-1" role="none">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Custom...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Fin Autres Statistiques--}}



{{--Audience Par age--}}
<div class="mt-8 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-full">
        <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Personnels de l'entreprise par age </h3>
        <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">50+</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$staffs50Rate}}%"></div>
            </div>
        </div>
        <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">40+</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$staffs40Rate}}%"></div>
            </div>
        </div>
        <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">30+</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$staffs30Rate}}%"></div>
            </div>
        </div>
        <div class="flex items-center mb-2">
            <div class="w-16 text-sm font-medium dark:text-white">20+</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$staffs20Rate}}%"></div>
            </div>
        </div>
    </div>
    <div id="traffic-channels-chart" class="w-full"></div>
</div>
{{--Fin Audience Par age--}}



<script>
    const planningCompleted = @json($planningCompleted);
    const planningIncompleted = @json($planningIncompleted);
    console.log(planningCompleted);
    const options = {
        colors: ["#1A56DB", "#FDBA8C"],
        series: [
            {
                name: "Tache Complétée",
                color: "#1A56DB",
                data: planningCompleted,
            },
            {
                name: "Tache Non Complétée",
                color: "#e80f16",
                data: planningIncompleted,
            },
        ],
        chart: {
            type: "bar",
            height: "320px",
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 8,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
            },
        },
        stroke: {
            show: true,
            width: 0,
            colors: ["transparent"],
        },
        grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -14
            },
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        xaxis: {
            floating: false,
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                }
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: false,
        },
        fill: {
            opacity: 1,
        },
    }

    if(document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("column-chart"), options);
        chart.render();
    }

</script>
@endsection


