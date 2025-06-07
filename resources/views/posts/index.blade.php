
<x-layout :title="$pageTitle">
    <h2>Blog</h2>
    <ul>
        @foreach ($posts as $post )
            <li>{{$post->title}}</li>
            <li>{{$post->body}}</li>
        @endforeach
    </ul>
</x-layout>