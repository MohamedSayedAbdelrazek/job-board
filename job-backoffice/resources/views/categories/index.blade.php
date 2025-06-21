<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                📁 Job Categories
            </h2>
            <a href="{{ route('categories.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition">
                ➕ Add New Category
            </a>
        </div>
    </x-slot>

    {{-- Success Message --}}
        <x-toast-notification/>
        
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gradient-to-r from-indigo-500 to-blue-500 text-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Category Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobCategories as $category)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $category->name }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-yellow-200 transition">
                                    ✍️ Edit
                                </a>
                                <a href="{{ route('categories.show', $category->id) }}" class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition">
                                    👁️ Show
                                </a>
                                <form method="POST" action="{{ route('categories.destroy', $category->id) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to archive this category?')" class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold hover:bg-red-200 transition">
                                        🗃️ Archive
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-gray-500 py-6">No job categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 px-4">
                {{ $jobCategories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
