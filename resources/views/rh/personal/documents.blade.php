@extends('dashboard')

@section('title', 'Mes Documents')

@section('contents')

    <div class="flex justify-between">
        <h1 class="text-3xl font-bold">Mes Documents</h1>
        <a href="{{ route('rh.documents.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Ajouter un document</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-8">
        @foreach($documents as $document)
            <div class=" dark:bg-gray-800 shadow-lg rounded-lg p-4
                {{ $document->type === 'Pièce d\'identité' ? 'bg-red-200' : '' }}
                {{ $document->type === 'Curriculum vitae' ? 'bg-blue-200' : '' }}
                {{ $document->type === 'Diplôme' ? 'bg-green-200' : '' }}
                {{ $document->type === 'Contrat de travail' ? 'bg-yellow-200' : '' }}
                {{ $document->type === 'Facture' ? 'bg-indigo-200' : '' }}
                {{ $document->type === 'Bon de commande' ? 'bg-purple-200' : '' }}
                {{ $document->type === 'Devis' ? 'bg-pink-200' : '' }}
                {{ $document->type === 'Contrat commercial' ? 'bg-orange-200' : '' }}
                {{ $document->type === 'Relevé bancaire' ? 'bg-teal-200' : '' }}
                {{ $document->type === 'Rapport d\'activité' ? 'bg-cyan-200' : '' }}
                {{ $document->type === 'Compte-rendu de réunion' ? 'bg-gray-200' : '' }}
                {{ $document->type === 'Procès-verbal d\'assemblée générale' ? 'bg-red-600' : '' }}
                {{ $document->type === 'Statuts de l\'entreprise' ? 'bg-blue-300' : '' }}
                {{ $document->type === 'Document de présentation' ? 'bg-green-300' : '' }}
                {{ $document->type === 'Document technique' ? 'bg-yellow-300' : '' }}
                {{ $document->type === 'Correspondance' ? 'bg-indigo-300' : '' }}
            ">
                <div class="p-4">
                    <div class="flex items-center">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $document->type }}</h4>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('rh.documents.edit', $document) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                        <a href="{{ route('rh.documents.download', $document) }}" class="text-green-600 hover:text-green-900 ml-2">Telecharger</a>
                        <a href="{{ route('rh.documents.preview', $document) }}" class="text-green-600 hover:text-green-900 ml-2">Preview</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
