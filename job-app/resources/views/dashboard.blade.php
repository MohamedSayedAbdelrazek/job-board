<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Job Dashboard') }}
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
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-xl shadow-2xl p-6 mb-8 border border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-bold text-white mb-2">
                            {{ __('Welcome back,') }} <span class="text-indigo-400">{{ Auth::user()->name }}</span>
                        </h3>
                        <p class="text-indigo-200">You have {{ $jobs->total() }} opportunities waiting</p>
                    </div>
                    <div class="bg-indigo-500/10 p-4 rounded-lg border border-indigo-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="bg-gray-900 rounded-xl shadow-lg p-6 mb-8 border border-gray-800">
                <div class="flex flex-col md:flex-row md:items-center justify-between space-y-4 md:space-y-0">
                    <!-- Search Bar -->
                    <form action="" class="relative w-full md:w-1/3">
                        <div class="flex">
                            <input type="text" 
                                   class="w-full p-3 rounded-l-lg bg-gray-800 text-white border border-gray-700 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200 placeholder-gray-400"
                                   placeholder="Search jobs, companies...">
                            <button type="submit"
                                    class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 rounded-r-lg border border-indigo-500 hover:from-indigo-600 hover:to-purple-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <span class="ml-2">Search</span>
                            </button>
                        </div>
                    </form>

                    <!-- Filters -->
                    <div class="flex flex-wrap gap-2">
                        <a href="#" class="px-4 py-2 rounded-lg bg-gray-800 text-indigo-400 border border-gray-700 hover:bg-gray-700 hover:border-indigo-400 transition duration-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filters
                        </a>
                        <a href="#" class="px-4 py-2 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 hover:bg-indigo-500/20 transition duration-200">Full-Time</a>
                        <a href="#" class="px-4 py-2 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 hover:bg-indigo-500/20 transition duration-200">Remote</a>
                        <a href="#" class="px-4 py-2 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 hover:bg-indigo-500/20 transition duration-200">Hybrid</a>
                        <a href="#" class="px-4 py-2 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 hover:bg-indigo-500/20 transition duration-200">Contract</a>
                    </div>
                </div>
            </div>

            <!-- Job List -->
            <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden border border-gray-800">
                <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">
                        Latest Job Opportunities
                    </h3>                                       <!--@MAGIC-->
                    <span class="text-sm text-indigo-400">{{ $jobs->total() }} results</span>
                </div>

                <div class="divide-y divide-gray-800">
                    @foreach ($jobs as $job)
                    <div class="p-6 hover:bg-gray-800/50 transition duration-200 group">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xl">
                                        <!--@MAGIC-->
                                        {{ strtoupper(substr($job->company->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="text-xl font-semibold text-white group-hover:text-indigo-400 transition duration-200">{{ $job->title }}</a>
                                    <div class="flex flex-wrap items-center mt-1 text-sm text-gray-300 space-x-4">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            {{ $job->company->name }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $job->location }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            ${{ number_format($job->salary) }}/year
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/30">
                                    {{ $job->type }}
                                </span>
                                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-500/10 text-green-400 border border-green-500/30">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Active
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-800">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>