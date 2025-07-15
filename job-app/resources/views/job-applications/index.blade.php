<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                My Applications
            </h2>
            <div class="flex items-center space-x-4">
                <span class="text-indigo-300">{{ now()->format('l, F j, Y') }}</span>
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </x-slot>

    {{-- Success Message --}}
    <x-toast-notification/>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400">Total Applications</p>
                            <p class="text-2xl font-bold text-white">{{ $jobApplications->total() }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-indigo-500/10 text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400">Pending</p>
                            <p class="text-2xl font-bold text-yellow-400">{{ $statusCounts['Pending'] ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-500/10 text-yellow-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400">Accepted</p>
                            <p class="text-2xl font-bold text-green-400">{{ $statusCounts['Accepted'] ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-500/10 text-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-800/50 rounded-xl p-4 border border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-400">Rejected</p>
                            <p class="text-2xl font-bold text-red-400">{{ $statusCounts['Rejected'] ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-red-500/10 text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications List -->
            <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden border border-gray-800">
                <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">
                        Recent Applications
                    </h3>
                    <div class="relative">
                        <!--@TODO redirect to the same page but show only the status chosen-->
                        <form action="{{ url()->current() }}" method="get">
                        <select name="status" onchange="this.form.submit()"
                         class="appearance-none bg-gray-800 border border-gray-700 text-white rounded-lg pl-4 pr-8 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500" >
                            <option value="" {{ request('status')==null??'selected'}}>All Statuses</option>
                            <option value="Pending"  {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                            <option value="Accepted" {{ request('status')=='Accepted'?'selected':'' }}>Accepted</option>
                            <option value="Rejected" {{ request('status')=='Rejected'?'selected':'' }}>Rejected</option>
                        </select>
                        </form>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>

                    </div>

                </div>

                <div class="divide-y divide-gray-800">
                    @forelse($jobApplications as $jobApplication)
                    <div class="p-6 hover:bg-gray-800/50 transition duration-200">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="flex items-start space-x-4 mb-4 md:mb-0">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl">
                                        {{ strtoupper(substr($jobApplication->jobVacancy->company->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-white">{{ $jobApplication->jobVacancy->title }}</h4>
                                    <div class="flex flex-wrap items-center mt-1 text-sm text-gray-300 space-x-4">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            {{ $jobApplication->jobVacancy->company->name }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $jobApplication->jobVacancy->location }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Applied {{ $jobApplication->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                @php
                                    $statusClass = match($jobApplication->status) {
                                        'Pending' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/30',
                                        'Accepted' => 'bg-green-500/10 text-green-400 border-green-500/30',
                                        'Rejected' => 'bg-red-500/10 text-red-400 border-red-500/30',
                                        default => 'bg-gray-500/10 text-gray-400 border-gray-500/30'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                    {{ $jobApplication->status }}
                                </span>
                                @if($jobApplication->aiGeneratedScore)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                                    Score: {{ $jobApplication->aiGeneratedScore }}/100
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Additional Details (Collapsible) -->
                        <div class="mt-4 pt-4 border-t border-gray-800">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h5 class="text-sm font-medium text-gray-400 mb-2">Applied With</h5>
                                    <div class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-white">{{ $jobApplication->resume->fileName }}</p>
                                            <a href="{{ Storage::disk('cloud')->url($jobApplication->resume->fileUri) }}" target="_blank" class="text-sm text-indigo-400 hover:underline">View Resume</a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-400 mb-2">Job Type</h5>
                                    <p class="text-white">{{ $jobApplication->jobVacancy->type }}</p>
                                </div>
                            </div>

                            @if($jobApplication->aiGeneratedFeedback)
                            <div class="mt-4">
                                <h5 class="text-sm font-medium text-gray-400 mb-2">AI Feedback</h5>
                                <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700">
                                    <p class="text-gray-300">{{ $jobApplication->aiGeneratedFeedback }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 class="mt-3 text-lg font-medium text-white">No Applications Found</h4>
                        <p class="mt-1 text-gray-400">You haven't applied to any jobs yet.</p>
                        <a href="{{ route('dashboard') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                            Browse Jobs
                        </a>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-800">
                    {{ $jobApplications->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>