@extends('dashboard')

@section('title', 'Absences')

@section('contents')
{{-- Utilisation de tailwind css   --}}
    <form action="{{ isset($absence) ? route('rh.absences.update', $absence) : route('rh.absences.store') }}" method="POST">
        @csrf
        @isset($absence)
            @method('PUT')
        @endisset
        <div class="flex justify-between">
            <h1 class="text-3xl font-bold">{{ isset($absence) ? 'Edit Absence' : 'Add Absence' }}</h1>
            <a href="{{ route('rh.absences.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>
        </div>
        <div class="mt-4">
            <div class="mb-4">
                <label for="staff_id" class="block text-gray-700 text-sm font-bold mb-2">Employee</label>
                <select name="staff_id" id="staff_id" class="w-full border px-4 py-2 rounded">
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ isset($absence) && $absence->staff_id == $staff->id ? 'selected' : '' }}>{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                <input type="date" name="date" id="date" class="w-full border px-4 py-2 rounded" value="{{ isset($absence) ? $absence->date : '' }}">
            </div>
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                <select name="type" id="type" class="w-full border px-4 py-2 rounded">
                    <option value="sick" {{ isset($absence) && $absence->type == 'sick' ? 'selected' : '' }}>Sick</option>
                    <option value="vacation" {{ isset($absence) && $absence->type == 'vacation' ? 'selected' : '' }}>Vacation</option>
                    <option value="personal" {{ isset($absence) && $absence->type == 'personal' ? 'selected' : '' }}>Personal</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                <select name="status" id="status" class="w-full border px-4 py-2 rounded">
                    <option value="pending" {{ isset($absence) && $absence->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ isset($absence) && $absence->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ isset($absence) && $absence->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ isset($absence) ? 'Update' : 'Create' }}</button>
            </div>
        </div>
    </form>
@endsection
