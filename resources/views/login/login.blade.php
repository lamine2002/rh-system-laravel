@extends('base')

@section('title', 'Login')

@section('content')

    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset("assets/image5.jpg") }}" alt="Office" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset("assets/image5.jpg") }}" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="text-center mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Se Connecter</h1>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input type="email" name="email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary focus:outline-none focus:ring dark:text-gray-300 dark:focus:ring-primary dark:focus:border-primary rounded-md border-gray-300" required />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input type="password" name="password" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-primary focus:outline-none focus:ring dark:text-gray-300 dark:focus:ring-primary dark:focus:border-primary rounded-md border-gray-300"  required />
                            </label>
                            <button type="submit" class="block w-full px-4 py-2 mt-6 text-sm font-semibold text-center text-white bg-blue-600 rounded-lg dark:bg-primary-dark hover:bg-blue-500 focus:outline-none focus:ring">Se Connecter</button>
                        </form>
                        <a href="/" class="block w-full px-4 py-2 mt-6 text-sm font-semibold text-center text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
