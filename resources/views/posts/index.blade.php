<x-layout :title="$pageTitle">
        @foreach ($posts as $post )
            <div>{{$post->title}}</div>
            <div>{{$post->body}}</div>
            <hr>
        @endforeach
        {{ $posts->links() }}
</x-layout>