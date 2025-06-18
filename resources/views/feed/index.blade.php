<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl font-bold text-gray-800">My Feed</h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">See what your friends have been tracking recently.</p>
            </div>
            <div>
{{--                search bar here--}}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                @forelse ($meals as $meal)
                    <div class="group bg-white rounded-xl shadow-lg transition-all duration-300 ease-in-out hover:shadow-2xl">

                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <div class="font-semibold text-gray-800">{{ $meal->user->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        Posted {{ $meal->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('friends.meals.show', $meal) }}" class="block p-6">
                            <div class="flex flex-col sm:flex-row sm:space-x-6">
                                <div class="w-full sm:w-1/3 flex-shrink-0">
                                    <div class="relative">
                                        @if ($meal->image_path)
                                            <img class="w-full h-40 object-cover rounded-lg" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                                        @else
                                            <div class="w-full h-40 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg"></div>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 flex-grow">
                                    <h4 class="font-bold text-2xl text-gray-800">{{ $meal->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-2">
                                        Click to see details and full nutritional information.
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow-md text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">Your Feed is Empty</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">When your friends post meals, they will show up here.</p>
                        <div class="mt-6">
                            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Find Friends
                            </a>
                        </div>
                    </div>
                @endforelse

                <div class="mt-8">
                    {{ $meals->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
