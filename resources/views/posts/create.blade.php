<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 max-w-3xl mx-auto">
                    <x-validation-errors :errors="$errors" />

                    <h3 class="text-2xl uppercase text-gray-600 mt-4">Create a post</h3>

                    <form action="{{ route('posts.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="mt-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />
                            <textarea class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="description" id="description" rows="10" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mt-4 flex items-center">
                            <x-button class="ml-3">
                                {{ __('Save') }}
                            </x-button>
                            <x-nav-link :href="url()->previous()" class="ml-4">{{ __('Cancel') }}</x-nav-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
