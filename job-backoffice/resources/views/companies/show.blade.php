<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                📁 <span>{{ $company->name }}</span>
            </h2>
            <a href="{{ route('companies.index') }}" class="text-sm text-blue-600 hover:underline">
                ← Back to Companies
            </a>
        </div>
    </x-slot>

    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="mx-auto bg-white shadow-xl rounded-2xl p-6 space-y-6 border border-gray-200 w-full max-w-5xl">
            <!-- Company Header -->
            <div class="flex items-center gap-4">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full shadow">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M9 21V6m6 15V6m4-3H5a2 2 0 00-2 2v16a1 1 0 001 1h16a1 1 0 001-1V5a2 2 0 00-2-2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $company->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $company->industry ?? 'No industry specified' }}</p>
                </div>
            </div>

            <!-- Company Info -->
            <div class="text-sm text-gray-700 space-y-2">
                <p><span class="font-semibold">📍 Address:</span> {{ $company->address ?? 'Not provided' }}</p>
                <p>
                    <span class="font-semibold">🌐 Website:</span>
                    @if ($company->website)
                        <a href="{{ $company->website }}" class="text-blue-600 hover:underline" target="_blank">
                            {{ $company->website }}
                        </a>
                    @else
                        Not provided
                    @endif
                </p>
                <p><span class="font-semibold">👤 Owner:</span> {{ $company->owner->name }}</p>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('companies.edit', $company->id) }}"
                    class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200 transition">
                    ✍️ Edit Company
                </a>

                <form method="POST" action="{{ route('companies.destroy', $company->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to archive this company?')"
                        class="bg-red-100 text-red-800 px-4 py-2 rounded-md text-sm font-medium hover:bg-red-200 transition">
                        🗃️ Archive
                    </button>
                </form>
            </div>

            <!-- Tabs -->
            <div class="border-t pt-4">
                <ul class="flex gap-3">
                    <li>
                        <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'jobs']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request('tab') == 'jobs' || request('tab') == '' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            💼 Jobs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'applications']) }}"
                            class="px-4 py-2 rounded-full text-sm font-medium transition
                            {{ request('tab') == 'applications' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            📄 Applications
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div>
                @if(request('tab') == 'jobs' || request('tab') == '')
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow">
                            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                <tr>
                                    <th class="py-3 px-4 rounded-tl-lg">Title</th>
                                    <th class="py-3 px-4">Location</th>
                                    <th class="py-3 px-4">Type</th>
                                    <th class="py-3 px-4">Salary</th>
                                    <th class="py-3 px-4 rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                                @foreach($company->jobVacancies as $job)
                                    <tr>
                                        <td class="py-2 px-4">{{ $job->title }}</td>
                                        <td class="py-2 px-4">{{ $job->location }}</td>
                                        <td class="py-2 px-4">{{ $job->type }}</td>
                                        <td class="py-2 px-4">{{ $job->salary }}</td>
                                        <td class="py-2 px-4">
                                            <a class="text-blue-600 hover:underline" href="{{ route('job-vacancies.show', $job->id) }}">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if(request('tab') == 'applications')
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg shadow">
                            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                                <tr>
                                    <th class="py-3 px-4 rounded-tl-lg">Applicant</th>
                                    <th class="py-3 px-4">Job Title</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700 divide-y divide-gray-200">
                                @foreach($company->jobApplications as $application)
                                    <tr>
                                        <td class="py-2 px-4">{{ $application->user->name }}</td>
                                        <td class="py-2 px-4">{{ $application->jobVacancy->title }}</td>
                                        <td class="py-2 px-4">{{ $application->status }}</td>
                                        <td class="py-2 px-4">
                                            <a class="text-blue-600 hover:underline" href="{{ route('job-applications.show', $application->id) }}">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
