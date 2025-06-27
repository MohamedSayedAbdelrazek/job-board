<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                📄 <span>{{ $jobApplication->jobVacancy->title }} : {{ $jobApplication->user->name }}</span>
            </h2>
            <a href="{{ route('job-applications.index') }}" class="text-sm text-blue-600 hover:underline">
                ← Back to Job Applications
            </a>
        </div>
    </x-slot>

    <!-- Toast -->
    <x-toast-notification/>

    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="mx-auto bg-white shadow-2xl rounded-2xl p-8 space-y-8 border border-gray-200 w-full max-w-5xl">

            <!-- Header Card -->
            <div class="flex items-center gap-5">
                <!-- أيقونة "Resume/Profile Document" -->
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full shadow">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M9 12h6m-6 4h6M15 3H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2V8l-5-5z" />
                    </svg>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        @if($jobApplication->jobVacancy->title)
                            <a target="_blank" href="{{ route('job-vacancies.show', $jobApplication->jobVacancy->id) }}" class="hover:underline">
                                {{ $jobApplication->jobVacancy->title }}
                            </a>
                        @else
                            <span class="text-gray-500 italic">N/A</span>
                        @endif
                    </h3>
                    <p class="text-sm text-gray-500">Applicant: {{ $jobApplication->user->name }}</p>
                </div>
            </div>

            <!-- Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 text-sm text-gray-700">
             <div>
                    <span class="font-medium text-gray-900">📜 Resume:</span>
                    <p class="mt-1">
                        @if ($jobApplication->resume->fileUri)
                            <a target="_blank" href="{{ $jobApplication->resume->fileUri }}" class="text-blue-600 hover:underline">
                                {{ $jobApplication->resume->fileName }}
                            </a>
                        @else
                            <span class="text-gray-500 italic">N/A</span>
                        @endif
                    </p>
                </div>

                <div>
                    <span class="font-medium text-gray-900">📌 Status:</span>

                    <p class="mt-1">
                    <!--@MAGIC-->
                        @php
                         $statusColor = match($jobApplication->status) {
                            'Pending' => 'bg-yellow-100 text-yellow-800',
                            'Accepted' => 'bg-green-100 text-green-800',
                            'Rejected' => 'bg-red-100 text-red-800',
                            default => 'bg-gray-100 text-gray-800'
                             };
                        @endphp

                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                            {{ $jobApplication->status }}
                        </span>
                    </p>
                </div>

                <div>
                    <span class="font-medium text-gray-900">🏬 Company:</span>
                    <p class="mt-1">
                        @if ($jobApplication->jobVacancy->company->name)
                            <a target="_blank" href="{{ route('companies.show',$jobApplication->jobVacancy->company->id)}}" class="text-blue-600 hover:underline">
                                {{ $jobApplication->jobVacancy->company->name }}
                            </a>
                        @else
                            <span class="text-gray-500 italic">N/A</span>
                        @endif
                    </p>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('job-applications.edit', ['job_application' => $jobApplication->id, 'redirectToList' => true]) }}"
                   class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-md text-sm font-semibold hover:bg-yellow-200 transition">
                    ✍️ Edit Application
                </a>

                <form method="POST" action="{{ route('job-applications.destroy', $jobApplication->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to archive this application?')"
                            class="bg-red-100 text-red-800 px-4 py-2 rounded-md text-sm font-semibold hover:bg-red-200 transition">
                        🗃️ Archive Application
                    </button>
                </form>
            </div>

              <!-- Tabs -->
            <div class="border-t pt-4">
                <ul class="flex gap-3">
                    <li>
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id, 'tab' => 'resume']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request('tab') == 'resume' || request('tab') == '' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            📜 Resume
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id, 'tab' => 'AIFeedback']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request('tab') == 'AIFeedback' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            📄 AI Feedback
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div>
<!--Resume Tab-->
                @if(request('tab') == 'resume' || request('tab') == '')
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow">
                            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                <tr>
                                    <th class="py-3 px-4 rounded-tl-lg">Summary</th>
                                    <th class="py-3 px-4">Skills</th>
                                    <th class="py-3 px-4">Experience</th>
                                    <th class="py-3 px-4">Education</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                                
                                    <tr>
                                        <td class="py-2 px-4">{{ $jobApplication->resume->summary }}</td>
                                        <td class="py-2 px-4">{{ $jobApplication->resume->skills}}</td>
                                        <td class="py-2 px-4">{{ $jobApplication->resume->experience}}</td>
                                        <td class="py-2 px-4">{{ $jobApplication->resume->education }}</td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                @endif

<!--AI Feedback Tab-->
                @if(request('tab') == 'AIFeedback')
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow">
                            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                <tr>
                                    <th class="py-3 px-4 rounded-tl-lg">💡 AI Score</th>
                                    <th class="py-3 px-4"> 🧠 AI Feedback</th>
                                    
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                                
                                    <tr>
                                        <td class="py-2 px-4">{{ $jobApplication->aiGeneratedScore }}</td>
                                        <td class="py-2 px-4">{{ $jobApplication->aiGeneratedFeedback }}</td>
                                    </tr>
                               
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
