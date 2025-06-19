<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl font-bold text-gray-800">My Friends</h2>
                <p class="mt-1 text-sm text-gray-500">Manage your friend requests and connections.</p>
            </div>
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shrink-0">
                Find New Friends
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if($pendingRequests->isNotEmpty())
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800">Pending Requests</h3>
                    <div class="mt-4 space-y-4">
                        @foreach ($pendingRequests as $requester)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <span class="font-medium text-gray-800">{{ $requester->name }}</span>
                                    <span class="text-sm text-gray-500"> sent you a request.</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <form method="POST" action="{{ route('friends.accept', $requester) }}">
                                        @csrf
                                        <x-primary-button>Accept</x-primary-button>
                                    </form>
                                    <form method="POST" action="{{ route('friends.decline', $requester) }}">
                                        @csrf
                                        <x-secondary-button>Decline</x-secondary-button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Your Friends ({{ $friends->count() }})</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse ($friends as $friend)
                        <div class="bg-white rounded-xl shadow-lg flex flex-col text-center transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl">
                            <div class="h-32 bg-gray-100 rounded-t-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <h4 class="font-bold text-xl text-gray-800 truncate">{{ $friend->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Friends since {{ $friend->pivot->updated_at->format('M Y') }}</p>
                                </div>
                                <div class="mt-6">
                                    <form method="POST" action="{{ route('friends.remove', $friend) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" class="w-full justify-center">Unfriend</x-danger-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-lg shadow-md text-center py-16">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 15l-6 6m0 0l-6-6m6 6V9a6 6 0 0112 0v3" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No Friends Yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Use the "Find New Friends" button to start connecting.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
