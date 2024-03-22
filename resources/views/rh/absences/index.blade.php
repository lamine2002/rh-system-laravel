@extends('dashboard')

@section('title', 'Absences')

@section('contents')
{{-- Utilisation de tailwind css   --}}
<div class="flex justify-between">
    <h1 class="text-3xl font-bold">Absences</h1>
    <a href="{{ route('rh.absences.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Absence</a>
</div>
<div class="mt-4">
    <table class="w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">Employee</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absences as $absence)
            <tr>
                <td class="border px-4 py-2">{{ $absence->staff->name }}</td>
                <td class="border px-4 py-2">{{ $absence->date }}</td>
                <td class="border px-4 py-2">{{ $absence->type }}</td>
                <td class="border px-4 py-2">{{ $absence->status }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('rh.absences.edit', $absence) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</a>
                    <form action="{{ route('rh.absences.destroy', $absence) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
