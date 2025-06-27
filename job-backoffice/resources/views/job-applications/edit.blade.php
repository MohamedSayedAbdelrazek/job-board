<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-6 py-4 bg-white shadow-sm rounded-b-md">
            <h2 class="text-2xl font-extrabold text-gray-800 flex items-center gap-2">
                📝 Edit Applicant Status
            </h2>

            <a href="{{ route('job-applications.index') }}"
               class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:underline">
                ← Back to Job Applications
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100">

            <form action="{{ route('job-applications.update', ['job_application' => $jobApplication->id, 'redirectToList' => request()->query('redirectToList')]) }}"
                  method="POST"
                  class="space-y-10">
                @csrf
                @method('PUT')

                {{-- Section: Details --}}
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-1 border-b pb-2">
                            🏢 Application Info
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">You can update the applicant’s current status below.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">👤 Applicant</label>
                            <div class="text-sm text-gray-600">{{ $jobApplication->user->name }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">💼 Job Vacancy</label>
                            <div class="text-sm text-gray-600">{{ $jobApplication->jobVacancy->title }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">🏢 Company</label>
                            <div class="text-sm text-gray-600">{{ $jobApplication->jobVacancy->company->name }}</div>
                        </div>

                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">💡 AI Generated Score</label>
                            <div class="text-sm text-gray-600"> {{ $jobApplication->aiGeneratedScore }}</div>
                        </div>


                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">🧠 AI Generated Feedback</label>
                            <div class="text-sm text-gray-600">{{ $jobApplication->aiGeneratedFeedback }}</div>
                        </div>


                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">📊 Status</label>
                            <select name="status" id="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="Accepted" {{ old('status', $jobApplication->status) === 'Accepted' ? 'selected' : '' }}>
                                    ✅ Accepted
                                </option>
                                <option value="Pending" {{ old('status', $jobApplication->status) === 'Pending' ? 'selected' : '' }}>
                                    ⏳ Pending
                                </option>
                                <option value="Rejected" {{ old('status', $jobApplication->status) === 'Rejected' ? 'selected' : '' }}>
                                    ❌ Rejected
                                </option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section: Submit --}}
                <div class="pt-6 text-right">
                    <button type="submit"
                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
                        ♻️ Update Status
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
