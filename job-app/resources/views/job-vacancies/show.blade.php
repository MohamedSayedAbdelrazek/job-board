<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ $jobVacancy->title }} - Job Details
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
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-indigo-400 hover:text-indigo-300 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Jobs
                </a>
            </div>

            <!-- Main Job Card -->
            <div class="bg-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-800 mb-8">
                <!-- Job Header -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 border-b border-gray-800">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl">
                                    {{ strtoupper(substr($jobVacancy->company->name, 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">{{ $jobVacancy->title }}</h1>
                                <div class="flex flex-wrap items-center mt-2 text-sm text-gray-300 space-x-4">
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        {{ $jobVacancy->company->name }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $jobVacancy->location }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        ${{ number_format($jobVacancy->salary) }}/year
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                                {{ $jobVacancy->type }}
                            </span>
                            <span class="ml-2 inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-500/10 text-green-400 border border-green-500/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Active
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Job Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <!-- Job Description -->
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Job Description
                                </h3>
                                <div class="prose prose-invert max-w-none text-gray-300">
                                    {!! nl2br(e($jobVacancy->description)) !!}
                                </div>
                            </div>

                            <!-- Required Skills -->
                            <div class="mb-8">
                                <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    Required Skills
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $jobVacancy->required_skills) as $skill)
                                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-gray-800 text-gray-300 border border-gray-700">
                                        {{ trim($skill,'[ ] " "') }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1">
                            <!-- Job Details -->
                            <div class="bg-gray-800 rounded-lg p-5 border border-gray-700 mb-6">
                                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Job Details
                                </h3>
                                <ul class="space-y-3">
                                    <li class="flex justify-between">
                                        <span class="text-gray-400">Posted</span>
                                        <span class="text-white">{{ $jobVacancy->created_at->diffForHumans() }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-400">Views</span>
                                        <span class="text-white">{{ number_format($jobVacancy->view_count) }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-400">Job Type</span>
                                        <span class="text-white">{{ $jobVacancy->type }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-400">Salary</span>
                                        <span class="text-white">${{ number_format($jobVacancy->salary) }}/year</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-400">Location</span>
                                        <span class="text-white">{{ $jobVacancy->location }}</span>
                                    </li>
                                    <li class="flex justify-between">
                                        <span class="text-gray-400">Category</span>
                                        <span class="text-white">{{ $jobVacancy->jobCategory->name ?? 'N/A' }}</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- Apply Button -->
                            <a href="{{ route('job-vacancies.apply',$jobVacancy->id) }}" class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 px-4 rounded-lg font-medium hover:from-indigo-600 hover:to-purple-700 transition duration-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Apply Now
                            </a>

                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</x-app-layout>