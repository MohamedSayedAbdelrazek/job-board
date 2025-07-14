<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4 py-4 bg-white shadow-sm rounded-b-md">
            <h2 class="text-xl font-semibold text-gray-800">
                ➕ Add New Job Vacancy
            </h2>
            <a href="{{ route('job-vacancies.index') }}"
               class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                ← Back to Job Vacancies
            </a>
        </div>
    </x-slot>

    <div class="py-10 px-4 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">

            <form action="{{ route('job-vacancies.store') }}" method="POST" class="space-y-10">
                @csrf

                {{-- Job Vacancy Details --}}
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2">🏢 job Vacancy Details</h3>
                    <p class="text-sm text-gray-500">Enter the job Vacancy details below</p>

                    {{-- job Vacancy title --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">📁 Job Vacancy title</label>
                        <input type="text" name="title" id="title" placeholder="Enter job vacancy title"
                               value="{{ old('title') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                               {{ $errors->has('title') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}"
                               required>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>
   
                    
                    {{-- Location --}}
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">🏠 location</label>
                        <input type="text" name="location" id="location" placeholder="Enter job vacancy location"
                               value="{{ old('location') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                               {{ $errors->has('location') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}"
                               required>
                        @error('location')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Salary --}}
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 mb-1"> Expected Salary (USD)</label>
                        <input type="number" name="salary" id="website" placeholder="Enter job salary"
                               value="{{ old('salary') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                               {{ $errors->has('salary') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}">
                        @error('salary')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                     {{-- Type --}}
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1"> Type</label>
                        <select name="type" id="type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach ($types as $type)                     {{-- @MAGIC --}}
                                <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CompanyID --}}
                     <div>
                        <label for="companyId" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
                        <select name="companyId" id="companyId"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach ($companies as $company)                     
                                <option value="{{ $company->id }}" {{ old('companyId') === $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('companyId')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>
                    
                     {{-- CategoryId --}}
                     <div>
                        <label for="jobCategoryId" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="jobCategoryId" id="jobCategoryId"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach ($categories as $category)                     
                                <option value="{{ $category->id }}" {{ old('jobCategoryId') === $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('jobCategoryId')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                      {{-- job Vacancy description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">📃 Description</label>
                        <textarea rows="4"   required name="description" id="description" placeholder="Enter job vacancy description" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition">{{ old('description') }}</textarea>
                        @error('location')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Required Skills --}}
                    <div>
                        <label for="required_skills" class="block text-sm font-medium text-gray-700 mb-1">🛠️ Required Skills</label>
                        <input type="text" 
                            name="required_skills" 
                            id="required_skills" 
                            placeholder="Enter skills separated by commas (e.g. React.js, TypeScript)"
                            value="{{ old('required_skills') }}"
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                            {{ $errors->has('required_skills') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}">
                        <p class="mt-1 text-sm text-gray-500">Separate multiple skills with commas</p>
                        @error('required_skills')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>
                           
                </div>

              

                {{-- Submit --}}
                <div class="text-right pt-4">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition duration-200">
                        ➕ Add job Vacancy
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
