<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                ➕ Create New Category
            </h2>
            <a href="{{ route('categories.index') }}" class="text-sm text-blue-600 hover:underline">
                ← Back to Categories
            </a>
        </div>
    </x-slot>

    <!-- Content Area -->
    <div class="py-10 px-4">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">

            <!-- Form -->
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        📁 Category Name
                    </label>
                    <input type="text"
                     name="name" 
                     id="name" 
                     placeholder="Enter category name" 
                     value="{{old('name')}}"
                    class="w-full px-4 py-2 transition 
        {{ $errors->has('name') 
            ? 'outline outline-red-500 outline-2 rounded-md' 
            : 'border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500' 
        }}"
                    required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">⚠️ {{$message}}</p>
                        @enderror
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition">
                        ➕ Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
