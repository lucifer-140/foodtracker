<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}'s Profile</h2>
                <p class="mt-1 text-sm text-gray-500">Viewing meals tracked by {{ $user->name }}.</p>
            </div>
            <a href="{{ route('friends.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shrink-0">
                &larr; Back to My Friends
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($meals as $meal)
                    <a href="{{ route('friends.meals.show', $meal) }}" class="group block bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                        <div class="relative">
                            @if ($meal->image_path)
                                <img class="w-full h-56 object-cover rounded-t-xl" src="{{ asset('storage/' . $meal->image_path) }}" alt="{{ $meal->name }}">
                            @else
                                <div class="w-full h-56 bg-gray-100 rounded-t-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-1.5a2.5 2.5 0 012.5-2.5h13A2.5 2.5 0 0121 17.5V19m-18 0a2.5 2.5 0 002.5 2.5h13A2.5 2.5 0 0021 19m-18 0h18M9 12a4 4 0 100-8 4 4 0 000 8z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-t-xl"></div>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-xl text-gray-800 truncate">{{ $meal->name }}</h4>
                            <p class="text-sm text-gray-500 mt-1">Tracked {{ $meal->created_at->format('F j, Y') }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow-md text-center py-16">
                        <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $user->name }} has not tracked any meals yet.</h3>
                    </div>
                @endforelse
            </div>
            <div class="mt-8">
                {{ $meals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
