<x-layout :title="$pageTitle">
    @if (session('success'))
        <div class="text-green-800 px-4 py-2 rounded">{{session('success')}}</div>
    @endif
      <a href="{{ route('posts.create') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Post</a>
</br></br>
        @foreach ($posts as $post )
            <div>{{$post->title}}</div>
            <div>{{$post->author}}</div>
</br>
            <div>
            <a href="{{ route('posts.edit',$post->id) }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>

            <form method="POST" action="{{ route('posts.destroy',$post->id) }}">
                @method('delete')
                @csrf
                <input type="submit" value="Delete" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
            </form>
            </div>
        </br>
            <hr>
        @endforeach
        {{ $posts->links() }}
</x-layout>