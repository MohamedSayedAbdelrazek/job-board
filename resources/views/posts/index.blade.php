<x-layout :title="$pageTitle">
    @if (session('success'))
        <div class="bg-green-50 px-3 py-2">{{session('success')}}</div>
    @endif
      <a href="{{ route('posts.create') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add Post</a>
</br></br>
        @foreach ($posts as $post )
            <div>{{$post->title}}</div>
            <div>{{$post->body}}</div>
            <hr>
        @endforeach
        {{ $posts->links() }}
</x-layout>