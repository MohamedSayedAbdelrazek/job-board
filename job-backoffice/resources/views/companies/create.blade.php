<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-4 py-4 bg-white shadow-sm rounded-b-md">
            <h2 class="text-xl font-semibold text-gray-800">
                ➕ Add New Company
            </h2>
            <a href="{{ route('companies.index') }}"
               class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                ← Back to Companies
            </a>
        </div>
    </x-slot>

    <div class="py-10 px-4 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">

            <form action="{{ route('companies.store') }}" method="POST" class="space-y-10">
                @csrf

                {{-- Company Details --}}
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2">🏢 Company Details</h3>
                    <p class="text-sm text-gray-500">Enter the company details below</p>

                    {{-- Company Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">📁 Company Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter company name"
                               value="{{ old('name') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                               {{ $errors->has('name') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}"
                               required>
                        @error('name')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">🏠 Address</label>
                        <input type="text" name="address" id="address" placeholder="Enter company address"
                               value="{{ old('address') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                               {{ $errors->has('address') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}"
                               required>
                        @error('address')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Industry --}}
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-1">🏭 Industry</label>
                        <select name="industry" id="industry"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            @foreach ($industries as $industry)
                                <option value="{{ $industry }}" {{ old('industry') === $industry ? 'selected' : '' }}>
                                    {{ $industry }}
                                </option>
                            @endforeach
                        </select>
                        @error('industry')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Website --}}
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-1">🌐 Website (optional)</label>
                        <input type="text" name="website" id="website" placeholder="Enter company website"
                               value="{{ old('website') }}"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                               {{ $errors->has('website') ? 'border-red-500 ring-red-200' : 'border-gray-300' }}">
                        @error('website')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>
                    
                </div>

                {{-- Owner Details --}}
                <div class="space-y-5">
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2">👤 Owner Details</h3>
                    <p class="text-sm text-gray-500">Enter the company owner details</p>

                    {{-- Owner Name --}}
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700 mb-1">👨‍💼 Owner Name</label>
                        <input type="text" name="owner_name" id="owner_name" placeholder="Enter owner name"
                               value="{{ old('owner_name') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('owner_name')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Owner Email --}}
                    <div>
                        <label for="owner_email" class="block text-sm font-medium text-gray-700 mb-1">📧 Owner Email</label>
                        <input type="email" name="owner_email" id="owner_email" placeholder="Enter owner email"
                               value="{{ old('owner_email') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('owner_email')
                        <p class="mt-1 text-sm text-red-600">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div x-data="{ showPassword: false }">
                        <label for="owner_password" class="block text-sm font-medium text-gray-700 mb-1">🔑 Owner Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="owner_password" id="owner_password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   placeholder="Enter password" required>

                            <button type="button" @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.522 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 012.041-3.368M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('owner_password')" class="mt-2"/>
                    </div>

                </div>

                {{-- Submit --}}
                <div class="text-right pt-4">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow-md transition duration-200">
                        ➕ Add Company
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
