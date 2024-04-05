@extends('dashboard')

@section('title', 'My Team')

@section('contents')
<h1 class="mb-8 text-3xl font-bold text-gray-900 dark:text-white">Mon Equipe : {{ $team->name }}</h1>
<div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
        <li class="me-2">
            <button id="team-tab" data-tabs-target="#team" type="button" role="tab" aria-controls="team" aria-selected="true" class="inline-block p-4 text-blue-600 rounded-ss-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">Equipe</button>
        </li>
        <li class="me-2">
            <button id="completed-plannings-tab" data-tabs-target="#completed-plannings" type="button" role="tab" aria-controls="completed-plannings" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Taches Complétées</button>
        </li>
        <li class="me-2">
            <button id="incompleted-plannings-tab" data-tabs-target="#incompleted-plannings" type="button" role="tab" aria-controls="incompleted-plannings" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Taches Incomplétées</button>
        </li>
    </ul>
    <div id="defaultTabContent">
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="team" role="tabpanel" aria-labelledby="team-tab">
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Membre de l'equipe</h2>
            <ul>
                @foreach($members as $member)
                    <div class="flex justify-between">
                        <li>{{ $member->name }}</li>
                        <a href="#" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Déléguer la tâche</a>
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="completed-plannings" role="tabpanel" aria-labelledby="completed-plannings-tab">
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Taches Complétées</h2>
            <ul>
                @foreach($completedTeamPlannings as $planning)
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold">{{ $planning->type }} : </h1>
                        <li class="text-green-500 ml-4">{{ $planning->task }}</li>
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="incompleted-plannings" role="tabpanel" aria-labelledby="incompleted-plannings-tab">
            <h2 class="mb-3 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Taches Incomplétées</h2>
            <ul>
                @foreach($incompletedTeamPlannings as $planning)
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold">{{ $planning->type }} : </h1>
                        <li class="text-red-500 ml-4">{{ $planning->task }}</li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
