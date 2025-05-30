<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
     <h1>Job board</h1>

     @foreach ($jobs as $job)
     <li>{{ $job['title'] }} : {{$job['salary']  }}</li>
     @endforeach
</div>
