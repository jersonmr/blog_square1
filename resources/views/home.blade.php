<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-gray-100">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="w-full fixed top-0 right-0 bg-gray-100 px-6 py-4 md:block text-right">
                    <div class="max-w-6xl mx-auto">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            @endif

            <div class="max-w-6xl py-12 mx-auto sm:px-6 md:px-8 md:py-6">
                <div class="md:mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @forelse($posts as $post)
                            <div class="p-6">
                                <h4 class="text-lg leading-7 font-semibold">
                                    <a href="https://laravel.com/docs" class="underline text-gray-600 dark:text-white">{{ $post->title }}</a>
                                </h4>
                                <p class="mt-2 mb-4 text-gray-500 dark:text-gray-700 text-sm">
                                    {{ $post->description }}
                                </p>
                                <time class="text-xs text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-2 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $post->publication_date->diffForHumans() }}
                                </time>
                            </div>
                        @empty
                            <div class="px-4 py-6 text-gray-500 col-span-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h1 class="justify-center text-4xl uppercase">{{ __('There is not posts added') }}</h1>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 pb-6">
            {{ $posts->links() }}
        </div>
    </body>
</html>
