@extends('dashboard')

@section('contents')
{{--Grid de 4 cards tailwind--}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-gradient-to-r from-lime-400 via-lime-500 to-lime-600 hover:bg-gradient-to-br shadow-xl rounded p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i></div>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">100</h5>
                <h5 class="font-bold text-lg">Empleados</h5>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br shadow-xl rounded p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-user-tie fa-2x fa-fw fa-inverse"></i></div>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">10</h5>
                <h5 class="font-bold text-lg">Gerentes</h5>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br shadow-xl rounded p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-user-tie fa-2x fa-fw fa-inverse"></i></div>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">20</h5>
                <h5 class="font-bold text-lg">Supervisores</h5>
            </div>
        </div>
    </div>
    <div class="bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br shadow-xl rounded p-4">
        <div class="flex items center">
            <div class="flex-shrink pr-4">
                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-user-tie fa-2x fa-fw fa-inverse"></i></div>
            </div>
            <div class="flex-1">
                <h5 class="font-bold text-2xl">70</h5>
                <h5 class="font-bold text-lg">Operarios</h5>
            </div>
        </div>
    </div>
</div>
{{--Fin de Grid de 4 cards tailwind--}}

@endsection
