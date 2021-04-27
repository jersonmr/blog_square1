<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 lg:py-6">
            <div class="flex flex-col">

                <x-alert :message="session('message')" class="mb-4"></x-alert>

                <div class="sm:flex sm:justify-between mb-4 text-center sm:text-left">
                    <form action="{{ route('dashboard') }}">
                        <div class="flex items-center justify-center sm:justify-start">
                            <x-label for="publication_date" :value="__('Sort by')" class="uppercase"/>
                            <select name="publication_date" id="publication_date"
                                    class="mx-4 appearance-none outline-none border-0">
                                <option value="" selected>Select...</option>
                                <option value="newest">Newest</option>
                                <option value="oldest">Oldest</option>
                            </select>
                            <x-button>Apply</x-button>
                        </div>
                    </form>

                    <x-link-btn :href="route('posts.create')"
                                class="mt-4 sm:mt-0">{{ __('Create a new post') }}</x-link-btn>
                </div>

                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            @if($posts->isNotEmpty())
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Title') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Description') }}
                                        </th>
                                        <th scope="col"
                                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Publication date') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($posts as $post)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-normal">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $post->title }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-normal">
                                                <div class="text-sm text-gray-500">{{ $post->description }}</div>
                                            </td>
                                            <td class="flex items-center px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-3.5 w-3.5 mr-2 text-red-800" fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $post->publication_date->format('Y-m-d') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="px-4 py-6 bg-white text-gray-500 flex justify-center items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-500"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <h1 class="justify-center text-4xl uppercase">{{ __("You haven't published posts") }}</h1>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="my-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
