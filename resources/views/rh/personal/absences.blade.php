@extends('dashboard')

@section('title', 'Absences')

@section('contents')

{{-- Utilisation de tailwind css   --}}
<div class="flex justify-between">
    <h1 class="text-3xl font-bold">Mes Absences</h1>
    <a href="{{ route('rh.absences.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Ajouter une Absence</a>
</div>

{{-- mes absences sous formes de card avec la couleur orange si c'est en attente, vert si c'est accepte et rouge si c'est refuse et deux options supprimer ou modifier tant que c'est en attente --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
    @foreach($absences as $absence)
        @can('view', $absence)
            <div class="rounded-lg overflow-hidden shadow-lg p-6
                {{ $absence->status === 'En attente' ? 'bg-orange-300' : '' }}
                {{ $absence->status === 'Approuvée' ? 'bg-green-300' : '' }}
                {{ $absence->status === 'Rejetée' ? 'bg-red-300' : '' }}">
                <div class="font-bold text-xl mb-2">{{ $absence->staff->name }}</div>
                <p class="text-gray-700 text-base">
                    <span class="text-4xs font-bold"> Raison</span> : {{ $absence->reason }}<br>
                    {{-- formater la date en format francaise                    --}}
                   <span class="text-4xs font-bold"> Date de Debut </span> : {{ date('d/m/Y', strtotime($absence->start_date)) }}<br>
                    <span class="text-4xs font-bold">Date de Fin</span> : {{ date('d/m/Y', strtotime($absence->end_date)) }}<br>
                    <span class="text-4xs font-bold">Status</span> : {{ $absence->status }}
                </p>
                @if($absence->status === 'En attente')
                    <div class="mt-4">
                        <a href="{{ route('rh.absences.edit', $absence) }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Modifier</a>
                        <form method="post" action="{{ route('rh.absences.destroy', $absence) }}" class="inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg">Annuler</button>
                        </form>
                    </div>
                @endif
            </div>
        @endcan
    @endforeach
</div>

@endsection
