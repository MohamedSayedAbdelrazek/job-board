<x-layout :title="$pageTitle">

    @php
        $userRole=auth()->user()->role;
    @endphp
    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-100 p-4 text-green-800 border border-green-300 shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($userRole=='admin')
        <div class="mb-6 flex justify-end">
        <a href="{{ route('posts.create') }}" 
           class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
            + Add Post
        </a>
    </div>
    @endif
    

    <div class="space-y-6">
        @foreach ($posts as $post)
            <div class="rounded-lg border border-gray-200 p-6 shadow-sm bg-white">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-gray-800">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-500">Author: {{ $post->author }}</p>
                </div>

                <div class="flex space-x-4">
                    @if (in_array($userRole,['admin','editor']))
                    <a href="{{ route('posts.edit', $post->id) }}" 
                       class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                        Edit
                    </a>
                    @endif

                    @if ($userRole=='admin')
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" 
                          onsubmit="return confirm('Are you sure? This action cannot be undone.')" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                            Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

</x-layout>
