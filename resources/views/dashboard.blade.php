<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 lg:py-6">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    @foreach($posts as $post)
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
                                {{ $post->publication_date->format('Y-m-d') }}
                            </time>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
