@extends('dashboard')

@section('contents')
{{--Grid de 4 cards tailwind--}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-gradient-to-r from-lime-400 via-lime-500 to-lime-600 hover:bg-gradient-to-br shadow-2xl rounded-xl p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
{{--                <div class="rounded-full p-5 bg-blue-600">--}}
                    <svg class="w-9 h-9" aria-hidden="true"  viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#046C4E" d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zm-55.808 536.384-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.272 38.272 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336L456.192 600.384z"/>
                    </svg>
{{--                </div>--}}
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">
                    {{ $completedTeamPlannings }}
                </h5>
                <h5 class="font-bold text-lg">
                    Tache d'équipe completée
                </h5>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br shadow-2xl rounded-xl p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <svg class="w-9 h-9" fill="#C81E1E"  viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: none;
                            }
                        </style>
                    </defs>
                    <path d="M30,24a6,6,0,1,0-6,6A6.0066,6.0066,0,0,0,30,24Zm-2,0a3.9521,3.9521,0,0,1-.5669,2.019L21.981,20.5669A3.9529,3.9529,0,0,1,24,20,4.0045,4.0045,0,0,1,28,24Zm-8,0a3.9521,3.9521,0,0,1,.5669-2.019l5.4521,5.4521A3.9529,3.9529,0,0,1,24,28,4.0045,4.0045,0,0,1,20,24Z" transform="translate(0 0)"/>
                    <path d="M14,2a12,12,0,1,0,2,23.82V24a8,8,0,0,1,8-8h1.82A11.9348,11.9348,0,0,0,14,2ZM12,18.5908l-4-4L9.5908,13,12,15.4092,17.4092,10,19,11.5908Z" transform="translate(0 0)"/>
                    <polygon id="inner-path" class="cls-1" points="12 18.591 8 14.591 9.591 13 12 15.409 17.409 10 19 11.591 12 18.591"/>
                    <rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/>
                </svg>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">
                    {{ $approvedAbsences }}
                </h5>
                <h5 class="font-bold text-lg">
                    Nombre d'absence approuvée
                </h5>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br shadow-2xl rounded-xl p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <svg class="w-9 h-9"  viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
                    <path d="M24 4L29.2533 7.83204L35.7557 7.81966L37.7533 14.0077L43.0211 17.8197L41 24L43.0211 30.1803L37.7533 33.9923L35.7557 40.1803L29.2533 40.168L24 44L18.7467 40.168L12.2443 40.1803L10.2467 33.9923L4.97887 30.1803L7 24L4.97887 17.8197L10.2467 14.0077L12.2443 7.81966L18.7467 7.83204L24 4Z" fill="#2F88FF" stroke="#000000" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17 24L22 29L32 19" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">
                    {{ $completedPersonalPlannings }}
                </h5>
                <h5 class="font-bold text-lg">
                    Tache personnel completée
                </h5>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br shadow-2xl rounded-xl p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <svg class="w-9 h-9"  viewBox="0 -3.5 1031 1031"   version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M556.978958 526.608333m-400.295833 0a400.295833 400.295833 0 1 0 800.591667 0 400.295833 400.295833 0 1 0-800.591667 0Z" fill="#ED7C84" />
                    <path d="M520.395625 903.695833c-229.2 0-415.670833-186.470833-415.670833-415.670833s186.470833-415.670833 415.670833-415.670833c229.204167 0 415.670833 186.470833 415.670833 415.670833s-186.466667 415.670833-415.670833 415.670833z m0-799.595833c-211.695833 0-383.920833 172.225-383.920833 383.920833s172.225 383.925 383.920833 383.925 383.925-172.229167 383.925-383.925c0-211.691667-172.229167-383.920833-383.925-383.920833z" fill="#332C2B" />
                    <path d="M516.616458 726.958333c-11.575 0-21.258333-3.779167-29.054166-11.458333-7.675-7.795833-11.575-17.479167-11.575-29.054167 0-11.458333 3.9-21.141667 11.575-28.9375 7.795833-7.675 17.479167-11.570833 29.054166-11.570833 11.458333 0 21.141667 3.9 28.9375 11.570833 7.675 7.795833 11.570833 17.479167 11.570834 28.9375 0 11.570833-3.9 21.258333-11.570834 29.054167-7.795833 7.679167-17.479167 11.458333-28.9375 11.458333z m11.458334-194.175v29.175h-23.033334v-29.175c0-52.320833-3.304167-105.116667-10.0375-158.379166-6.733333-53.266667-10.041667-92.595833-10.041666-117.754167 0-15.470833 2.3625-27.6375 7.204166-36.258333 4.845833-8.858333 12.875-13.108333 24.45-13.108334 13.345833 0 21.966667 4.841667 25.866667 14.529167 3.779167 9.566667 5.666667 21.258333 5.666667 34.841667 0 25.158333-3.304167 64.4875-10.0375 117.754166a1261.625 1261.625 0 0 0-10.0375 158.375z" fill="#332C2B" /><path d="M516.616458 742.829167c-15.875 0-29.4-5.3875-40.191666-16.020834-10.879167-11.045833-16.3125-24.570833-16.3125-40.366666 0-15.495833 5.579167-29.354167 16.1375-40.075 11.05-10.879167 24.570833-16.308333 40.366666-16.308334 15.495833 0 29.354167 5.579167 40.075 16.133334 10.729167 10.895833 16.308333 24.754167 16.308334 40.25 0 15.791667-5.429167 29.3125-16.133334 40.191666-10.966667 10.808333-24.45 16.195833-40.25 16.195834z m0-81.020834c-7.366667 0-13.058333 2.229167-17.916666 7.0125-4.608333 4.683333-6.8375 10.3375-6.8375 17.625 0 7.366667 2.229167 13.058333 7.0125 17.916667 4.604167 4.529167 10.295833 6.720833 17.741666 6.720833 7.370833 0 13.025-2.191667 17.795834-6.895833 4.608333-4.683333 6.841667-10.375 6.841666-17.741667 0-7.2875-2.229167-12.941667-7.0125-17.8-4.683333-4.608333-10.3375-6.8375-17.625-6.8375z m27.329167-83.975h-54.779167v-45.05c0-51.729167-3.333333-104.345833-9.9125-156.391666-6.745833-53.370833-10.166667-93.658333-10.166666-119.745834 0-18.5625 3.020833-32.9625 9.2375-44.033333 5.241667-9.591667 16.229167-21.2125 38.2875-21.2125 26.75 0 36.9125 15.3375 40.591666 24.479167 4.5375 11.475 6.816667 25.1625 6.816667 40.766666 0 26.1125-3.416667 66.4-10.158333 119.745834a1251.175 1251.175 0 0 0-9.916667 156.3875v45.054166z m-27.329167-354.679166c-7.866667 0-9.4 2.804167-10.520833 4.854166-2.445833 4.354167-5.258333 12.708333-5.258333 28.641667 0 24.758333 3.3375 63.708333 9.9125 115.766667a1287.583333 1287.583333 0 0 1 5.804166 55.5625c1.5375-18.554167 3.470833-37.091667 5.804167-55.5625 6.579167-52.029167 9.916667-90.975 9.916667-115.7625 0-11.595833-1.533333-21.354167-4.558334-29.004167-0.608333-1.516667-1.804167-4.495833-11.1-4.495833z" fill="#332C2B" /><path d="M156.541458 863.995833c-202.05-250.8375-208.5375-504.075-19.283333-752.666666l25.2625 19.229166C-19.266875 369.345833-13.133542 602.7375 181.266458 844.083333l-24.725 19.9125zM915.337292 852.904167l-26.904167-16.8625c150.6875-240.4125 147.679167-471.441667-9.195833-706.283334l26.4-17.633333c164.558333 246.3375 167.729167 488.65 9.7 740.779167z" fill="#332C2B" />
                </svg>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">
                    {{ $incompletedPersonalPlannings }}
                </h5>
                <h5 class="font-bold text-lg">
                    Tache personnel incompletée
                </h5>
            </div>
        </div>
    </div>
</div>
{{--Fin de Grid de 4 cards tailwind--}}

    {{--Graphe --}}


    <div class="max-w-6xl w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mt-16">
        <div class="flex justify-between mb-5">
            <div class="grid gap-4 grid-cols-2">
                <div>
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">Complétée
                        <svg data-popover-target="clicks-info" data-popover-placement="bottom" class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div data-popover id="clicks-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">Clicks growth - Incremental</h3>
                                <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                                <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                                <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg></a>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </h5>
                    <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">{{ $completedPersonalPlannings }}</p>
                </div>
                <div>
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">Incomplétée
                        <svg data-popover-target="cpc-info" data-popover-placement="bottom" class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div data-popover id="cpc-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">CPC growth - Incremental</h3>
                                <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                                <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                                <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                                <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg></a>
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </h5>
                    <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">{{ $incompletedPersonalPlannings }}</p>
                </div>
            </div>
            <div>
                {{--<button id="dropdownDefaultButton"
                        data-dropdown-toggle="lastDaysdropdown"
                        data-dropdown-placement="bottom" type="button" class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Last week <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg></button>--}}
                {{--<div id="lastDaysdropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 7 days</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 30 days</a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last 90 days</a>
                        </li>
                    </ul>
                </div>--}}
            </div>
        </div>
        <div id="line-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
            <div class="pt-5">
                <p class="text-center text-gray-900 dark:text-white text-2xl leading-none font-bold">Liste des taches complétées et incomplétées</p>
            </div>
        </div>
    </div>

{{--Fin de Graphe --}}


<script>

    let completedPersonalPlanningsByWeek = @json($completedPersonalPlanningsByWeek);
    let incompletedPersonalPlanningsByWeek = @json($incompletedPersonalPlanningsByWeek);
    let days = @json($days);
    console.log(incompletedPersonalPlanningsByWeek);

    const options = {
        chart: {
            height: "100%",
            maxWidth: "100%",
            type: "line",
            fontFamily: "Inter, sans-serif",
            dropShadow: {
                enabled: false,
            },
            toolbar: {
                show: false,
            },
        },
        tooltip: {
            enabled: true,
            x: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 6,
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -26
            },
        },
        series: [
            {
                name: "Taches Complétées",
                data: completedPersonalPlanningsByWeek,
                color: "#1A56DB",
            },
            {
                name: "Taches Incomplétées",
                data: incompletedPersonalPlanningsByWeek,
                color: "#F05252",
            },
        ],
        legend: {
            show: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            categories: days /*['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb']*/,
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
    }

    if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("line-chart"), options);
        chart.render();
    }


</script>


@endsection
