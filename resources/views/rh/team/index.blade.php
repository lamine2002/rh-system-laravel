@extends('dashboard')

@section('title', 'Équipes')

@section('contents')

<div class="flex justify-between">
    <h1 class="text-3xl font-bold">Équipes</h1>
    <a href="{{ route('rh.team.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Ajouter une équipe</a>
</div>

<div class="flex flex-col mt-8">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Nom
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Chef d'équipe
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Superviseur
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach($teams as $team)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $team->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $team->description }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $team->leader->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $team->supervisor->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('rh.team.edit', $team) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                            {{-- Voir --}}
                            <a href="{{ route('rh.team.show', $team) }}" class="text-indigo-600 hover:text-indigo-900">Voir</a>
                            {{-- Supprimer --}}
                            @can('delete', $team)
                            <form method="post" action="{{ route('rh.team.destroy', $team) }}" class="inline ml-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
