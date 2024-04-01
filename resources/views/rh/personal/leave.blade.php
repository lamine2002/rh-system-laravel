@extends('dashboard')

@section('title', 'Mes Congés')

@section('contents')

<div class="flex justify-between">
    <h1 class="text-3xl font-bold">Mes Congés</h1>
    <a href="{{ route('rh.leave.create') }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Ajouter une demande de congé</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
    @foreach($leaves as $leave)
        @if($leave->staff->name == Auth::user()->name)
            <div class="rounded-lg overflow-hidden shadow-lg p-6
                {{ $leave->status === 'En attente' ? 'bg-orange-300' : '' }}
                {{ $leave->status === 'Accepté' ? 'bg-green-300' : '' }}
                {{ $leave->status === 'Refusé' ? 'bg-red-300' : '' }}">
                <div class="font-bold text-xl mb-2">{{ $leave->type }}</div>
                <p class="text-gray-700 text-base">
                    Date de début: {{ $leave->start_date }}<br>
                    Date de fin: {{ $leave->end_date }}<br>
                    Status: {{ $leave->status }}
                </p>
                @if($leave->status === 'En attente')
                    <div class="mt-4">
                        <a href="{{ route('rh.leave.edit', $leave) }}" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Modifier</a>
                        <form method="post" action="{{ route('rh.leave.destroy', $leave) }}" class="inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">Annuler</button>
                        </form>
                    </div>
                @endif
            </div>
        @endif
    @endforeach
</div>

@endsection
