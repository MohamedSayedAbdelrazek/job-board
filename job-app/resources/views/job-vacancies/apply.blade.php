<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                Apply for {{ $jobVacancy->title }}
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
                <a href="{{ route('job-vacancies.show',$jobVacancy->id) }}" class="inline-flex items-center text-indigo-400 hover:text-indigo-300 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Job Details
                </a>
            </div>
         

            <!-- Application Form -->
            <div class="bg-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-800 mb-8">
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 border-b border-gray-800">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Application Form
                    </h3>
                </div>

                <div class="p-6">                                                                                                                     <!--@MAGIC-->                          
                    <form action="{{ route('job-vacancies.process-application',$jobVacancy->id) }}" method="post" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <!-- Applicant Info -->
                        <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700">
                            <h4 class="text-lg font-medium text-white mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Applicant Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="name" value="Full Name" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="Auth::user()->name" readonly />
                                </div>
                                <div>
                                    <x-input-label for="email" value="Email" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="Auth::user()->email" readonly />
                                </div>
                            </div>
                        </div>

                        <!-- Resume Selection -->
                        <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700">
                            <h4 class="text-lg font-medium text-white mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Resume Selection
                            </h4>

                            <!-- Existing Resumes -->
                            <div class="mb-6">
                                <x-input-label for="resume" value="Select from your existing resumes:" />
                            <!--@TODO-->
                            </div>

                            <!-- Upload New Resume -->
                            <div x-data="{ fileName: '', hasError: {{ $errors->has('resume_file') ? 'true' : 'false' }} }">
                                <x-input-label for="new_resume_file" value="Or upload a new resume:" />
                                <div class="mt-2">
                                    <label for="new_resume_file" class="block cursor-pointer">
                                        <div class="border-2 border-dashed rounded-lg p-6 text-center transition"
                                            :class="{
                                                'border-indigo-500': fileName,
                                                'border-gray-600 hover:border-indigo-400': !fileName && !hasError,
                                                'border-red-500': hasError
                                            }">
                                            <input @change="fileName = $event.target.files[0]?.name || ''; hasError = false" 
                                                   type="file" 
                                                   name="resume_file" 
                                                   id="new_resume_file" 
                                                   class="hidden" 
                                                   accept=".pdf,.doc,.docx">
                                            
                                            <div x-show="!fileName" class="space-y-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="text-gray-400">Drag and drop your file here or click to browse</p>
                                                <p class="text-xs text-gray-500">PDF, DOC, DOCX (Max 5MB)</p>
                                            </div>
                                            
                                            <div x-show="fileName" class="space-y-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p x-text="fileName" class="text-indigo-400 font-medium"></p>
                                                <p class="text-xs text-gray-400">Click to change file</p>
                                            </div>
                                        </div>
                                    </label>
                                    <x-input-error :messages="$errors->get('resume_file')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                       
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-3 rounded-lg font-medium hover:from-indigo-600 hover:to-purple-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                                Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>