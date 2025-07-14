<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-6 py-4 bg-white shadow-sm rounded-b-md">
            <h2 class="text-2xl font-extrabold text-gray-800 flex items-center gap-2">
                📝 Edit User Password
            </h2>

            <a href="{{ route('users.index') }}"
               class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:underline">
                ← Back to Users
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100">

            <form action="{{ route('users.update', ['user' => $user->id, 'redirectToList' => request()->query('redirectToList')]) }}"
                  method="POST"
                  class="space-y-10">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-1 border-b pb-2">
                             User Info
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">You can update the user's password below.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">👤 User</label>
                            <div class="text-sm text-gray-600">{{ $user->name }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">✉️ Email</label>
                            <div class="text-sm text-gray-600">{{ $user->email }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <div class="text-sm text-gray-600">{{ $user->role }}</div>
                        </div>

                        
                    {{-- Password --}}
                    <div x-data="{ showPassword: true }">
                        <label for="user_password" class="block text-sm font-medium text-gray-700 mb-1">🔑 Change User Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'password' : 'text'" name="user_password" id="user_password"
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
                        <x-input-error :messages="$errors->get('user_password')" class="mt-2"/>
                    </div>

                        
                    </div>
                </div>

                {{-- Section: Submit --}}
                <div class="pt-6 text-right">
                    <button type="submit"
                            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
                        ♻️ Update User Password
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
