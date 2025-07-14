<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                Notifications
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-indigo-300">{{ now()->format('l, F j, Y') }}</span>
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Notifications Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">
                    Your Notifications
                </h3>
                @if($notifications->count() > 0)
                    <form method="POST" action="{{ route('notifications.mark-all-as-read') }}">
                        @csrf
                        <button type="submit" class="text-sm text-indigo-400 hover:text-indigo-300 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            <!-- Notifications List -->
            <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden border border-gray-800">
                @forelse ($notifications as $notification)
                    <div class="@if($notification->unread()) bg-gray-800/50 @endif hover:bg-gray-800 transition duration-150 border-b border-gray-800 last:border-b-0">
                        <a href="{{ $notification->data['link'] ?? '#' }}" class="block px-6 py-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-white">
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-400 flex items-center">
                                        {{ $notification->created_at->diffForHumans() }}
                                        @if($notification->unread())
                                            <span class="ml-2 inline-block w-2 h-2 rounded-full bg-indigo-500"></span>
                                        @endif
                                    </p>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    @if($notification->unread())
                                        <form method="POST" action="{{ route('notifications.mark-as-read', $notification->id) }}">
                                            @csrf
                                            <button type="submit" class="text-xs text-indigo-400 hover:text-indigo-300">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-white">No notifications yet</h3>
                        <p class="mt-1 text-sm text-gray-400">When you get notifications, they'll appear here.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>