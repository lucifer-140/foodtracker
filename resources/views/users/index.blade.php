<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div class="mb-4 sm:mb-0">
                <h2 class="text-2xl font-bold text-gray-800">Find New Friends</h2>
                <p class="mt-1 text-sm text-gray-500">Browse all users to grow your network.</p>
            </div>
            <a href="{{ route('friends.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shrink-0">
                My Friends
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($users as $user)
                    <div class="bg-white rounded-xl shadow-lg flex flex-col text-center transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl">
                        <div class="h-32 bg-gray-100 rounded-t-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>

                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-xl text-gray-800 truncate">{{ $user->name }}</h4>
                                <p class="text-sm text-gray-500 mt-1">Joined {{ $user->created_at->diffForHumans() }}</p>
                            </div>

                            <div class="mt-6">
                                @php
                                    $friendship = auth()->user()->getFriendship($user);
                                @endphp

                                @if ($friendship && $friendship->status == 1)
                                    <form method="POST" action="{{ route('friends.remove', $user) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" class="w-full justify-center">Unfriend</x-danger-button>
                                    </form>
                                @elseif ($friendship && $friendship->status == 0)
                                    @if ($friendship->requester_id == auth()->id())
                                        <button class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-500 bg-gray-200 cursor-not-allowed" disabled>Request Sent</button>
                                    @else
                                        <div class="flex items-center space-x-2">
                                            <form method="POST" action="{{ route('friends.accept', $user) }}" class="w-1/2">
                                                @csrf
                                                <x-primary-button type="submit" class="w-full justify-center">Accept</x-primary-button>
                                            </form>
                                            <form method="POST" action="{{ route('friends.decline', $user) }}" class="w-1/2">
                                                @csrf
                                                <x-secondary-button type="submit" class="w-full justify-center">Decline</x-secondary-button>
                                            </form>
                                        </div>
                                    @endif
                                @else
                                    <form method="POST" action="{{ route('friends.add', $user) }}">
                                        @csrf
                                        <x-primary-button type="submit" class="w-full justify-center">Add Friend</x-primary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow-md text-center py-16">
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No Other Users Found</h3>
                        <p class="mt-1 text-sm text-gray-500">Looks like you're the first one here!</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
